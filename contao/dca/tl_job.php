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

use Contao\BackendUser;
use Contao\Config;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\System;

System::loadLanguageFile('tl_content');

$GLOBALS['TL_DCA']['tl_job'] = [
    // Config
    'config'      => [
        'dataContainer'    => DC_Table::class,
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id'        => 'primary',
                'published' => 'index',
                'tstamp'    => 'index',
            ]
        ]
    ],
    'list'        => [
        'sorting'           => [
            'mode'               => DataContainer::MODE_SORTABLE,
            'fields'             => ['title ASC'],
            'flag'               => 1,
            'panelLayout'        => 'filter;sort,search,limit',
            'defaultSearchField' => 'title',
            'renderAsGrid'       => true,
            'limitHeight'        => 160,
        ],
        'label'             => [
            'fields'      => ['title', 'createdAt'],
            'showColumns' => true,
        ],
        'global_operations' => [
            'all',
        ],
    ],
    // Palettes
    'palettes'    => [
        '__selector__' => ['addImage', 'addEnclosure', 'overwriteMeta'],
        'default'      => '{title_legend},author,createdAt;{meta_legend},title,alias,description;{image_legend},addImage;{enclosure_legend:hide},addEnclosure;{publish_legend},published',
    ],
    // Sub-palettes
    'subpalettes' => [
        'addImage'      => 'singleSRC,overwriteMeta',
        'addEnclosure'  => 'enclosure',
        'overwriteMeta' => 'alt,imageTitle,caption'
    ],
    // Fields
    'fields'      => [
        'id'            => [
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ],
        'sorting'       => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],
        'tstamp'        => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],
        'author'        => [
            'default'    => static fn() => BackendUser::getInstance()->id,
            'search'     => true,
            'filter'     => true,
            'flag'       => DataContainer::SORT_ASC,
            'inputType'  => 'select',
            'foreignKey' => 'tl_user.name',
            'eval'       => ['doNotCopy' => true, 'chosen' => true, 'mandatory' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'],
            'sql'        => "int(10) unsigned NOT NULL default 0",
            'relation'   => ['type' => 'belongsTo', 'load' => 'lazy'],
        ],
        'createdAt'     => [
            'exclude'   => false,
            'default'   => time(),
            'flag'      => DataContainer::SORT_DAY_DESC,
            'sorting'   => true,
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'datim', 'doNotCopy' => true, 'datepicker'=>true, 'tl_class' => 'w50 wizard'],
            'sql'       => "int(10) unsigned NOT NULL default 0",
        ],
        'title'         => [
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 255, 'decodeEntities' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
        'alias'         => [
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'alias', 'doNotCopy' => true, 'unique' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) BINARY NOT NULL default ''",
        ],
        'description'   => [
            'search'    => true,
            'inputType' => 'textarea',
            'eval'      => ['style' => 'height:60px', 'decodeEntities' => true, 'tl_class' => 'clr'],
            'sql'       => "text NULL",
        ],
        'addImage'      => [
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => ['submitOnChange' => true],
            'sql'       => ['type' => 'boolean', 'default' => false],
        ],
        'overwriteMeta' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['overwriteMeta'],
            'inputType' => 'checkbox',
            'eval'      => ['submitOnChange' => true, 'tl_class' => 'w50 clr'],
            'sql'       => ['type' => 'boolean', 'default' => false],
        ],
        'singleSRC'     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['singleSRC'],
            'inputType' => 'fileTree',
            'eval'      => ['fieldType' => 'radio', 'filesOnly' => true, 'extensions' => '%contao.image.valid_extensions%', 'mandatory' => true],
            'sql'       => "binary(16) NULL",
        ],
        'alt'           => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['alt'],
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
        'imageTitle'    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['imageTitle'],
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
        'caption'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['caption'],
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 255, 'allowHtml' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
        'addEnclosure'  => [
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => ['submitOnChange' => true],
            'sql'       => ['type' => 'boolean', 'default' => false],
        ],
        'enclosure'     => [
            'inputType' => 'fileTree',
            'eval'      => ['multiple' => true, 'fieldType' => 'checkbox', 'filesOnly' => true, 'isDownloads' => true, 'extensions' => Config::get('allowedDownload'), 'mandatory' => true, 'isSortable' => true],
            'sql'       => "blob NULL",
        ],
        'published'     => [
            'toggle'    => true,
            'filter'    => true,
            'flag'      => DataContainer::SORT_INITIAL_LETTER_DESC,
            'inputType' => 'checkbox',
            'eval'      => ['doNotCopy' => true],
            'sql'       => ['type' => 'boolean', 'default' => false],
        ]
    ]
];
