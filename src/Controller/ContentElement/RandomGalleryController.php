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
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'image')]
class RandomGalleryController extends AbstractContentElementController
{
    public const string TYPE = 'random_gallery';

    public function __construct(
        #[Autowire(param: 'kernel.project_dir')]
        private readonly string $projectDir,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $galleryDir = $this->projectDir.'/files/fileadmin/fotos/kinder';

        $finder = new Finder();
        $finder
            ->files()
            ->in($galleryDir)
            ->name(['*.jpg'])
        ;

        $files = iterator_to_array($finder);

        // Shuffle the array
        shuffle($files);

        // Select the first 12 elements
        $random = \array_slice($files, 0, 12);

        $arrPics = [];

        foreach ($random as $file) {
            $arrPics[] = Path::makeRelative($file->getRealPath(), $this->projectDir);
        }

        $template->set('pics', $arrPics);

        return $template->getResponse();
    }
}
