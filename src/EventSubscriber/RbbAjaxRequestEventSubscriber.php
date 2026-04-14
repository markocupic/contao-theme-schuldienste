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

namespace Markocupic\ContaoSchuldiensteTheme\EventSubscriber;

use Contao\FrontendUser;
use Markocupic\ResourceBookingBundle\AjaxController\ApplyFilterController;
use Markocupic\ResourceBookingBundle\AjaxController\RefreshDataController;
use Markocupic\ResourceBookingBundle\Event\AjaxRequestEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class RbbAjaxRequestEventSubscriber implements EventSubscriberInterface
{
    public const PRIORITY = 900;

    public function __construct(
        private readonly Security $security,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AjaxRequestEvent::class => ['hideBookingDetailsForGuests', self::PRIORITY],
        ];
    }

    /**
     * @throws \Exception
     */
    public function hideBookingDetailsForGuests(AjaxRequestEvent $event): void
    {
        $user = $this->security->getUser();

        if ($user instanceof FrontendUser) {
            return;
        }

        $data = $event->getAjaxResponse()->getAll();

        if (empty($data['action'])) {
            return;
        }

        if (RefreshDataController::REQUEST_NAME !== $data['action'] && ApplyFilterController::REQUEST_NAME !== $data['action']) {
            return;
        }

        if (empty($data['data']['rows'])) {
            return;
        }

        $rows = $data['data']['rows'];

        foreach ($rows as $k => $v) {
            if (empty($rows[$k]['cellData'])) {
                continue;
            }

            foreach ($rows[$k]['cellData'] as $kk => $vv) {
                if (empty($rows[$k]['cellData'][$kk]['bookings'])) {
                    continue;
                }

                foreach ($rows[$k]['cellData'][$kk]['bookings'] as $kkk => $vvv) {
                    $rows[$k]['cellData'][$kk]['bookings'][$kkk]['title'] = '';
                    $rows[$k]['cellData'][$kk]['bookings'][$kkk]['description'] = '';
                    $rows[$k]['cellData'][$kk]['bookings'][$kkk]['bookedByFullname'] = '';
                    $rows[$k]['cellData'][$kk]['bookings'][$kkk]['bookingDescription'] = '';
                    $rows[$k]['cellData'][$kk]['bookings'][$kkk]['bookingTitle'] = '';
                }
            }
        }

        $data['data']['rows'] = $rows;

        $response = $event->getAjaxResponse();
        $response->setDataFromArray($data['data']);
    }
}
