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

use Markocupic\ContaoSchuldiensteTheme\Model\JobModel;

// Add back end modules
$GLOBALS['BE_MOD']['content']['jobs'] = [
    'tables' => ['tl_job']
];

$GLOBALS['TL_MODELS'][JobModel::getTable()] = JobModel::class;
