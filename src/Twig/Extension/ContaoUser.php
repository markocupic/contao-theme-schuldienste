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

namespace Markocupic\ContaoSchuldiensteTheme\Twig\Extension;

use Contao\FrontendUser;
use Symfony\Bundle\SecurityBundle\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ContaoUser extends AbstractExtension
{
    public function __construct(
        private readonly Security $security,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('has_logged_in_frontend_user', [$this, 'hasLoggedInFrontendUser']),
            new TwigFunction('get_logged_in_frontend_user', [$this, 'getLoggedInFrontendUser']),
        ];
    }

    public function hasLoggedInFrontendUser(): bool
    {
        if ($this->security->getUser() instanceof FrontendUser) {
            return true;
        }

        return false;
    }

    public function getLoggedInFrontendUser(): FrontendUser|null
    {
        $user = $this->security->getUser();
        if ($user instanceof FrontendUser) {
            return $user;
        }

        return null;
    }
}
