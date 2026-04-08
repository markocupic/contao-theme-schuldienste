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

namespace Markocupic\ContaoSchuldiensteTheme\DataContainer;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;

readonly class Content
{
    #[AsCallback(table: 'tl_content', target: 'config.onpalette', priority: -100)]
    public function extendPaletteListener(string $palette, DataContainer $dc): string
    {
        return PaletteManipulator::create()
            ->addLegend('anchorLink_legend', 'expert_legend', PaletteManipulator::POSITION_BEFORE)
            ->addField(['anchorLink'], 'anchorLink_legend', PaletteManipulator::POSITION_PREPEND)
            ->addField(['marginTop', 'marginBottom'], 'expert_legend', PaletteManipulator::POSITION_PREPEND)
            ->applyToString($palette)
        ;
    }
}
