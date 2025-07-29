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

namespace Markocupic\ContaoSchuldiensteTheme\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'texts')]
class ContactController extends AbstractContentElementController
{
    public const string TYPE = 'contact';

    public function __construct()
    {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $template->set('company', $model->addr_company);
        $template->set('street', $model->addr_street);
        $template->set('postal', $model->addr_postal);
        $template->set('city', $model->addr_city);
        $template->set('email', $model->addr_email);
        $template->set('phone', $model->addr_phone);
        $template->set('phoneInt', $model->addr_phoneInt);
        $template->set('pageLink', $model->addr_pageLink);

        return $template->getResponse();
    }
}
