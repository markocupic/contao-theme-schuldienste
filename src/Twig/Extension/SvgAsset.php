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

namespace Markocupic\ContaoSchuldiensteTheme\Twig\Extension;

use Symfony\Component\Asset\Packages;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Path;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SvgAsset extends AbstractExtension
{
    public function __construct(
        private readonly Packages $packages,
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'inline_asset',
                [$this, 'inlineAsset'], [
                    'is_safe' => ['html'],
            ],
            ),
        ];
    }

    public function inlineAsset(string $path, string $packageName): string
    {
        // Asset-URL ermitteln (z. B. /files/icons/arrow.svg)
        $url = $this->packages->getUrl($path, $packageName);

        // Absoluten Pfad ermitteln
        $absolutePath = Path::makeAbsolute(Path::join('public/',$url), $this->projectDir);

        if (!is_file($absolutePath)) {
            return \sprintf('<!-- inline_asset: file not found: %s -->', $absolutePath);
        }

        return file_get_contents($absolutePath) ?: '';
    }
}
