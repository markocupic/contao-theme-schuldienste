<?php

declare(strict_types=1);

/*
 * This file is part of contao-schuldienste-theme.
 *
 * (c) Marko Cupic 2025 <m.cupic@gmx.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-schuldienste-theme
 */

namespace Markocupic\ContaoSchuldiensteTheme;

use Markocupic\ContaoSchuldiensteTheme\DependencyInjection\MarkocupicContaoSchuldiensteThemeExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarkocupicContaoSchuldiensteTheme extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getContainerExtension(): MarkocupicContaoSchuldiensteThemeExtension
    {
        return new MarkocupicContaoSchuldiensteThemeExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }
}
