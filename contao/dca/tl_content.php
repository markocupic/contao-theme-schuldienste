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

use Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement\AnchorLinkController;

// Content elements
$GLOBALS['TL_DCA']['tl_content']['palettes'][AnchorLinkController::TYPE] = '{type_legend},type,headline;{config_legend},anchorLinkContext';

// This field is injected into every content element
$GLOBALS['TL_DCA']['tl_content']['fields']['marginTop'] = [
    'exclude'   => true,
    'inputType' => 'select',
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'options'   => ['mt-none', 'mt-small', 'mt-medium', 'mt-large'],
    'eval'      => ['multiple' => false, 'includeBlankOption' => true, 'tl_class' => 'w25'],
    'sql'       => ['type' => 'string', 'length' => 32, 'default' => ''],
];

// This field is injected into every content element
$GLOBALS['TL_DCA']['tl_content']['fields']['marginBottom'] = [
    'exclude'   => true,
    'inputType' => 'select',
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'options'   => ['mb-none', 'mb-small', 'mb-medium', 'mb-large'],
    'eval'      => ['multiple' => false, 'includeBlankOption' => true, 'tl_class' => 'w25'],
    'sql'       => ['type' => 'string', 'length' => 32, 'default' => ''],
];

// This field belongs to the anchor_link content element
$GLOBALS['TL_DCA']['tl_content']['fields']['anchorLink'] = [
    'filter'    => true,
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['rgxp' => 'extnd', 'tl_class' => 'w25'],
    'sql'       => ['type' => 'string', 'length' => 32, 'default' => ''],
];

// This field belongs to the anchor_link content element
$GLOBALS['TL_DCA']['tl_content']['fields']['anchorLinkContext'] = [
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => ['#left', '#main', '#right'],
    'eval'      => ['multiple' => false, 'tl_class' => 'w25'],
    'sql'       => ['type' => 'string', 'length' => 32, 'default' => '#main'],
];
