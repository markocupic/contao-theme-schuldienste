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

use Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement\PageTitleController;
use Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement\ContactController;
use Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement\JobListController;
use Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement\BootstrapRowController;
use Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement\GoogleMapsController;
use Contao\DataContainer;

// Palettes
$GLOBALS['TL_DCA']['tl_content']['palettes'][PageTitleController::TYPE] = 'name,type,pageTitle,pageTitleList,pageTitleText;{source_legend},multiSRC,size,fullsize,overwriteMeta;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes'][ContactController::TYPE] = 'name,type,headline,addr_company,addr_street,addr_postal,addr_city,addr_email,addr_phone,addr_phoneInt,addr_pageLink;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes'][JobListController::TYPE] = 'name,type,headline,jobList_showImage;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes'][BootstrapRowController::TYPE] = 'name,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes'][GoogleMapsController::TYPE] = 'name,type,headline,gm_height,gm_title,gm_src;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID;{invisible_legend:hide},invisible,start,stop';

// Subpalettes
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['jobList_showImage'] = 'size,fullsize';

// Selectors
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'jobList_showImage';

$GLOBALS['TL_DCA']['tl_content']['fields']['pageTitle'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['pageTitleList'] = [
    'search'      => true,
    'inputType'   => 'textarea',
    'eval'        => ['mandatory' => false, 'basicEntities' => true, 'rte' => 'tinyMCE', 'helpwizard' => true],
    'explanation' => 'insertTags',
    'sql'         => "mediumtext NULL",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['pageTitleText'] = [
    'search'      => true,
    'inputType'   => 'textarea',
    'eval'        => ['mandatory' => false, 'basicEntities' => true, 'rte' => 'tinyMCE', 'helpwizard' => true],
    'explanation' => 'insertTags',
    'sql'         => "mediumtext NULL",
];

// Content element "Contact"
$GLOBALS['TL_DCA']['tl_content']['fields']['addr_company'] = [
    'search'    => true,
    'sorting'   => true,
    'flag'      => DataContainer::SORT_INITIAL_LETTER_ASC,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addr_street'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addr_postal'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 32, 'tl_class' => 'w50'],
    'sql'       => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addr_city'] = [
    'search'    => true,
    'sorting'   => true,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addr_email'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['mandatory' => true, 'maxlength' => 255, 'rgxp' => 'email', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addr_phone'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 64, 'rgxp' => 'phone', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addr_phoneInt'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 64, 'rgxp' => 'phone', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addr_pageLink'] = [
    'inputType'  => 'pageTree',
    'foreignKey' => 'tl_page.title',
    'eval'       => ['fieldType' => 'radio', 'tl_class' => 'clr'],
    'sql'        => "int(10) unsigned NOT NULL default 0",
    'relation'   => ['type' => 'hasOne', 'load' => 'lazy']
];

// Content element "Job List"
$GLOBALS['TL_DCA']['tl_content']['fields']['jobList_showImage'] = [
    'inputType' => 'checkbox',
    'eval'      => ['submitOnChange' => true],
    'sql'       => ['type' => 'boolean', 'default' => false],
];

// Content element "Google Maps"
$GLOBALS['TL_DCA']['tl_content']['fields']['gm_title'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['gm_height'] = [
    'inputType'  => 'text',
    'foreignKey' => 'tl_page.title',
    'eval'       => ['mandatory' => true, 'rgxp' => 'natural', 'tl_class' => 'w50'],
    'sql'        => "int(10) unsigned NOT NULL default 300",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['gm_src'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['mandatory' => true, 'maxlength' => 512, 'tl_class' => 'w100'],
    'sql'       => "varchar(512) NOT NULL default ''"
];
