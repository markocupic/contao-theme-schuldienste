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
use Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement\TextGalleryController;
use Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement\NestedFragmentSliderController;

// Content elements
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'addTextGallery';

$GLOBALS['TL_DCA']['tl_content']['palettes'][AnchorLinkController::TYPE] = '{type_legend},type,headline;{config_legend},anchorLinkContext';
$GLOBALS['TL_DCA']['tl_content']['palettes'][TextGalleryController::TYPE] = '{type_legend},type,headline,title;{text_legend},text;{source_legend},addTextGallery;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes'][NestedFragmentSliderController::TYPE] = 'name,type,headline;{template_legend},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

// Sub-palettes
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['addTextGallery'] = 'multiSRC,useHomeDir,sortBy,metaIgnore,size,fullsize';


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

// This field belongs to the text_gallery content element
$GLOBALS['TL_DCA']['tl_content']['fields']['addTextGallery'] = [
    'inputType' => 'checkbox',
    'eval'      => ['submitOnChange' => true],
    'sql'       => ['type' => 'boolean', 'default' => false]
];

