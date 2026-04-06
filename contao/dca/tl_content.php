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

$GLOBALS['TL_DCA']['tl_content']['fields']['marginTop'] = [
    'exclude'   => true,
    'inputType' => 'select',
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'options'   => ['mt-none', 'mt-small', 'mt-medium', 'mt-large'],
    'eval'      => ['multiple' => false, 'includeBlankOption' => true, 'tl_class' => 'w25'],
    'sql'       => ['type' => 'string', 'length' => 32, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['marginBottom'] = [
    'exclude'   => true,
    'inputType' => 'select',
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'options'   => ['mb-none', 'mb-small', 'mb-medium', 'mb-large'],
    'eval'      => ['multiple' => false, 'includeBlankOption' => true, 'tl_class' => 'w25'],
    'sql'       => ['type' => 'string', 'length' => 32, 'default' => ''],
];
