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

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Filesystem\FilesystemItem;
use Contao\CoreBundle\Filesystem\FilesystemUtil;
use Contao\CoreBundle\Filesystem\VirtualFilesystem;
use Contao\CoreBundle\Image\Studio\Figure;
use Contao\CoreBundle\Image\Studio\FigureBuilder;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Contao\System;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'texts')]
class TextGalleryController extends AbstractContentElementController
{
    public const string TYPE = 'text_gallery';

    public function __construct(
        private readonly InsertTagParser $insertTagParser,
        #[Autowire('@contao.image.studio')]
        private readonly Studio $studio,
        #[Autowire('@contao.filesystem.virtual.files')]
        private readonly VirtualFilesystem $filesStorage,
        #[Autowire('%contao.image.valid_extensions%')]
        private readonly array $validExtensions,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $text = $model->text;

        // Add the static files URL to images
        if ($staticUrl = System::getContainer()->get('contao.assets.files_context')->getStaticUrl()) {
            $path = System::getContainer()->getParameter('contao.upload_path').'/';
            $template->set('text', str_replace(' src="'.$path, ' src="'.$staticUrl.$path, (string) $text));
        }

        $template->set('text', StringUtil::encodeEmail((string) $text));

        $images = [];

        if ($model->addTextGallery) {
            // Find all images
            $filesystemItems = FilesystemUtil::listContentsFromSerialized($this->filesStorage, $model->multiSRC)
                ->filter(fn ($item) => \in_array($item->getExtension(true), $this->validExtensions, true))
            ;

            $arrItems = iterator_to_array($filesystemItems);

            if (!empty($arrItems)) {
                $figureBuilder = $this->getFigureBuilder($model, $model->size, $model->fullsize);

                $images = array_filter(array_map(
                    fn (FilesystemItem $filesystemItem): Figure|null => $figureBuilder
                        ->fromStorage($this->filesStorage, $filesystemItem->getPath())
                        ->buildIfResourceExists(),
                    $arrItems,
                ));
                $template->set('images', $images);
            }
        }

        return $template->getResponse();
    }

    private function getFigureBuilder(ContentModel $model, mixed $size, bool $fullsize): FigureBuilder
    {
        $figureBuilder = $this->studio->createFigureBuilder();

        $figureBuilder->setSize(StringUtil::deserialize($size));

        if ($fullsize) {
            $figureBuilder->setLightboxGroupIdentifier('lb_text_gallery_'.$model->id);
            $figureBuilder->enableLightbox();
        }

        return $figureBuilder;
    }
}
