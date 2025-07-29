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

namespace Markocupic\ContaoSchuldiensteTheme\EventListener\ContaoHook;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('replaceInsertTags')]
class ReplaceInsertTagsListener
{
    public function __invoke(string $tag, bool $useCache, string $cachedValue, array $flags, array $tags, array $cache, int $_rit, int $_cnt)
    {
        [$name, $param] = explode('::', $tag) + [null, null];

        if ('fa-icon' !== $name) {
            return false;
        }

        if (empty($param)) {
            return false;
        }

        return \sprintf('<i class="%s"></i>', $param);
    }
}
