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

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\System;
use Doctrine\DBAL\Connection;

readonly class Job
{
    public function __construct(
        private Connection $connection,
    ) {
    }

    #[AsCallback(table: 'tl_job', target: 'fields.alias.save', priority: 100)]
    public function generateAlias($varValue, DataContainer $dc)
    {
        $conn = $this->connection;
        $aliasExists = static function (string $alias) use ($dc, $conn): bool {
            $id = $conn->fetchOne('SELECT id FROM tl_job WHERE alias = ? AND id !=?',
                [$alias, $dc->id],
            );

            return $id > 0;
        };

        // Generate alias if there is none
        if (!$varValue) {
            $varValue = System::getContainer()->get('contao.slug')->generate($dc->activeRecord->title, $dc->activeRecord->id, $aliasExists);
        } elseif (preg_match('/^[1-9]\d*$/', $varValue)) {
            throw new \Exception(\sprintf($GLOBALS['TL_LANG']['ERR']['aliasNumeric'], $varValue));
        } elseif ($aliasExists($varValue)) {
            throw new \Exception(\sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
        }

        return $varValue;
    }
}
