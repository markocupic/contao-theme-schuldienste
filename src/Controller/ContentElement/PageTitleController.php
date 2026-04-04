<?php

declare(strict_types=1);

/*
 * This file is part of contao-schuldienste-theme.
 *
 * (c) Marko Cupic <m.cupic@gmx.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-schuldienste-theme
 */

namespace Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Filesystem\FilesystemItem;
use Contao\CoreBundle\Filesystem\FilesystemUtil;
use Contao\CoreBundle\Filesystem\VirtualFilesystem;
use Contao\CoreBundle\Image\Studio\Figure;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'texts')]
class PageTitleController extends AbstractContentElementController
{
    public const string TYPE = 'page_title';

    public function __construct(
        #[Autowire('@contao.filesystem.virtual.files')]
        private readonly VirtualFilesystem $filesStorage,
        private readonly Studio $studio,
        #[Autowire('%contao.image.valid_extensions%')]
        private readonly array $validExtensions,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $template->set('pageTitle', $model->pageTitle);
        $template->set('pageTitleList', $model->pageTitleList);
        $template->set('pageTitleText', $model->pageTitleText);
        $template->set('pageTitleImages', $this->getImageList($model) ?? null);

        return $template->getResponse();
    }

    private function getImageList(ContentModel $model): array
    {
        if ('' !== $model->multiSRC) {
            $images = $this->getContaoAdapter(StringUtil::class)->deserialize($model->multiSRC, true);
        } elseif ('' !== $model->singleSRC) {
            $images = [$model->singleSRC];
        } else {
            $images = [];
        }

        $filesystemItems = FilesystemUtil::listContentsFromSerialized($this->filesStorage, $images)
            ->filter(fn ($item) => \in_array($item->getExtension(true), $this->validExtensions, true))
        ;
        // die(print_r($filesystemItems, true));
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

        // die(print_r($images, true));
    }
}
