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
    #[AsCallback(table: 'tl_content', target: 'config.onload', priority: -100)]
    public function addMarginFieldsToPalettes(DataContainer $dc)
    {
        $palettes = $GLOBALS['TL_DCA']['tl_content']['palettes'];

        foreach ($palettes as $key => $value) {
            if ($key === '__selector__' || $key === 'default') {
                continue;
            }

            if (!str_contains($value, '{expert_legend')) {
                continue;
            }

            PaletteManipulator::create()
                ->addField(['marginTop', 'marginBottom'], 'expert_legend', PaletteManipulator::POSITION_PREPEND)
                ->applyToPalette($key, 'tl_content');
        }
    }
}
