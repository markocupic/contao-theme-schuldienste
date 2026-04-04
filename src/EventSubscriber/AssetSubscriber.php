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

namespace Markocupic\ContaoSchuldiensteTheme\EventSubscriber;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\Asset\Packages;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AssetSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly Packages     $packages,
        private readonly ScopeMatcher $scopeMatcher,
    )
    {
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => 'registerAssets'];
    }

    public function registerAssets(RequestEvent $e): void
    {
        $request = $e->getRequest();

        if ($this->scopeMatcher->isFrontendRequest($request)) {
            // Add Font Awesome
            $GLOBALS['TL_HEAD'][] = '<link rel="stylesheet" href="assets/contao-component-fontawesome-free/fontawesomefree/css/all.css">';

            // Add Google Fonts
            $GLOBALS['TL_HEAD'][] = '
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght,GRAD@0,17..18,400..700,-50..200;1,17..18,400..700,-50..200&display=swap" rel="stylesheet">
';

            // Add theme assets
            $GLOBALS['TL_HEAD'][] = '<script src="' . $this->packages->getUrl('js/theme.js', 'markocupic_contao_schuldienste_theme') . '"></script>';
            $GLOBALS['TL_HEAD'][] = '<link rel="stylesheet" href="' . $this->packages->getUrl('styles/frontend.css', 'markocupic_contao_schuldienste_theme') . '">';

            // Add Bootstrap JS
            $GLOBALS['TL_BODY'][] = '<script src="' . $this->packages->getUrl('bootstrap/dist/js/bootstrap.bundle.min.js', 'markocupic_contao_schuldienste_theme') . '"></script>';
        }
    }
}
