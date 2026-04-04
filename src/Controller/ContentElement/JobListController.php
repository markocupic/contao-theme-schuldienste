<?php

declare(strict_types=1);

/*
 * This file is part of Contao Schuldienste Theme.
 *
 * (c) Marko Cupic <m.cupic@gmx.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-schuldienste-theme
 */

namespace Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement;

use Contao\Config;
use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Exception\ResponseException;
use Contao\CoreBundle\Filesystem\FilesystemItem;
use Contao\CoreBundle\Filesystem\FilesystemItemIterator;
use Contao\CoreBundle\Filesystem\FilesystemUtil;
use Contao\CoreBundle\Filesystem\SortMode;
use Contao\CoreBundle\Filesystem\VirtualFilesystem;
use Contao\CoreBundle\Image\Studio\Figure;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Doctrine\DBAL\Connection;
use Markocupic\ContaoSchuldiensteTheme\Model\JobModel;
use Nyholm\Psr7\Uri;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\UriSigner;

#[AsContentElement(category: 'texts')]
class JobListController extends AbstractContentElementController
{
    public const string TYPE = 'job_list';

    public const string DOWNLOADS_SORT_MODE = 'custom';

    private const string PARAM_PATH = 'p';

    private const string PARAM_CONTEXT = 'ctx';

    private const string PARAM_DISPOSITION = 'd';

    private const string PARAM_FILE_NAME = 'f';

    public function __construct(
        private readonly Connection $connection,
        private readonly UriSigner $uriSigner,
        private readonly Studio $studio,
        #[Autowire('@contao.filesystem.virtual.files')]
        private readonly VirtualFilesystem $filesStorage,
        #[Autowire('%contao.image.valid_extensions%')]
        private readonly array $validExtensions,
    ) {
    }

    public function __invoke(Request $request, ContentModel $model, string $section, array|null $classes = null): Response
    {
        $response = $this->handleDownload($request, $model);

        if ($response instanceof BinaryFileResponse) {
            throw new ResponseException($response);
        }
        if ($response instanceof Response) {
            return $response;
        }

        return parent::__invoke($request, $model, $section, $classes);
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $rows = $this->connection->fetchAllAssociative('SELECT * FROM tl_job WHERE published = 1 ORDER BY title ASC');

        $jobs = [];

        foreach ($rows as $row) {
            $clonedModel = clone $model;
            $row['figure'] = null;

            if ($model->jobList_showImage && $row['addImage']) {
                // Take singleSRC,alt,imageTitle,imageUrl,caption from tl_job
                $clonedModel->addImage = true;
                $clonedModel->singleSRC = $row['singleSRC'];

                if ($row['overwriteMeta']) {
                    $clonedModel->overwriteMeta = true;
                    $clonedModel->alt = $row['alt'];
                    $clonedModel->imageTitle = $row['imageTitle'];
                    $clonedModel->caption = $row['caption'];
                }

                $row['figure'] = $this->getFigure($clonedModel)[0] ?? null;
            }

            $row['downloads'] = null;

            if ($row['addEnclosure']) {
                $filesystemItems = $this->getFilesystemItems($row['enclosure']);

                // Sort elements; relay to client-side logic if the list should be randomized
                if ($sortMode = SortMode::tryFrom(self::DOWNLOADS_SORT_MODE)) {
                    $filesystemItems = $filesystemItems->sort($sortMode);
                }

                $row['sort_mode'] = $sortMode;

                $jobModel = JobModel::findById($row['id']);
                $row['items'] = $this->compileDownloadsList($filesystemItems, $model, $jobModel, $request);
            }

            $jobs[] = $row;
            $clonedModel->delete();
        }

        $template->set('jobs', $jobs);

        return $template->getResponse();
    }

    private function getFilesystemItems(string $sources): FilesystemItemIterator
    {
        // Find filesystem items
        $filesystemItems = FilesystemUtil::listContentsFromSerialized($this->filesStorage, $sources);

        return $this->applyDownloadableFileExtensionsFilter($filesystemItems);
    }

    private function applyDownloadableFileExtensionsFilter(FilesystemItemIterator $filesystemItemIterator): FilesystemItemIterator
    {
        $this->initializeContaoFramework();

        $allowedDownload = StringUtil::trimsplit(',', $this->getContaoAdapter(Config::class)->get('allowedDownload'));

        return $filesystemItemIterator->filter(
            static fn (FilesystemItem $item): bool => \in_array(
                Path::getExtension($item->getPath(), true),
                array_map(strtolower(...), $allowedDownload),
                true,
            ),
        );
    }

    private function compileDownloadsList(FilesystemItemIterator $filesystemItems, ContentModel $contentModel, JobModel $jobModel, $request): array
    {
        $items = [];

        foreach ($filesystemItems->toArray() as $filesystemItem) {
            $file = [];
            $file['file'] = $filesystemItem;
            $params = [
                self::PARAM_CONTEXT => serialize([
                    'ce_id' => $contentModel->id,
                    'job_id' => $jobModel->id,
                ]),
                self::PARAM_PATH => $filesystemItem->getPath(),
                self::PARAM_FILE_NAME => $filesystemItem->getName(),
                self::PARAM_DISPOSITION => 'attachment',
            ];

            $file['href'] = $this->generateDownloadUrl($request->getUri(), $params);

            $items[] = $file;
        }

        return $items;
    }

    private function generateDownloadUrl(string $url, array $params): string
    {
        $uri = new Uri($url);
        parse_str($uri->getQuery(), $existingParams);
        $params = [...$existingParams, ...array_filter($params)];

        // Unset default uri_signer parameters (#7989)
        unset($params['_hash'], $params['_expiration']);

        return $this->uriSigner->sign((string) $uri->withQuery(http_build_query($params)));
    }

    private function handleDownload(Request $request, ContentModel $model): Response|null
    {
        $requiredParams = [
            self::PARAM_CONTEXT,
            self::PARAM_PATH,
            self::PARAM_FILE_NAME,
            self::PARAM_DISPOSITION,
        ];

        if (!array_intersect_key($request->query->all(), array_flip($requiredParams))) {
            return null;
        }

        if ('attachment' !== $request->query->get('d')) {
            return null;
        }

        if (!$this->uriSigner->checkRequest($request)) {
            return null;
        }

        $ctx = $this->getContaoAdapter(StringUtil::class)->deserialize($request->query->get('ctx'), true);

        $contentId = $ctx['ce_id'] ?? null;

        // Do not handle downloads for other content elements
        if ($contentId !== $model->id) {
            return null;
        }

        $jobId = $ctx['job_id'] ?? 0;
        $jobModel = JobModel::findById($jobId);

        if (null === $jobModel) {
            return null;
        }

        $file = $this->filesStorage->get($request->query->get('p'));

        if ($file->getName() !== $request->query->get('f')) {
            return null;
        }

        if (!$this->getFilesystemItems((string) $jobModel->enclosure)->any(static fn (FilesystemItem $listItem) => $listItem->getPath() === $file->getPath())) {
            return new Response('The resource can not be accessed anymore.', Response::HTTP_GONE);
        }

        $stream = $this->filesStorage->readStream($file->getPath());
        $metadata = stream_get_meta_data($stream);

        if ('STDIO' === $metadata['stream_type'] && 'plainfile' === $metadata['wrapper_type'] && Path::isAbsolute($localPath = $metadata['uri'])) {
            return $this->file($localPath);
        }

        return null;
    }

    private function getFigure(ContentModel $model): array
    {
        if ('' === $model->singleSRC) {
            return [];
        }

        $images = [$model->singleSRC];

        $filesystemItems = FilesystemUtil::listContentsFromSerialized($this->filesStorage, $images)
            ->filter(fn ($item) => \in_array($item->getExtension(true), $this->validExtensions, true))
        ;

        // Compile the list of images
        $figureBuilder = $this->studio
            ->createFigureBuilder()
            ->setSize($model->size)
            ->setLightboxGroupIdentifier('lb'.$model->id)
            ->enableLightbox($model->fullsize)
        ;

        $figureBuilder->setOverwriteMetadata($model->getOverwriteMetadata());

        return array_filter(array_map(
            fn (FilesystemItem $filesystemItem): Figure|null => $figureBuilder
                ->fromStorage($this->filesStorage, $filesystemItem->getPath())
                ->buildIfResourceExists(),
            iterator_to_array($filesystemItems),
        ));
    }
}
