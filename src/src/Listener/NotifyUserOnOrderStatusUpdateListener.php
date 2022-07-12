<?php

namespace App\Listener;

use App\Event\OrderStatusUpdateEvent;
use App\Notification\OrderUpdateStatusNotification;
use App\Service\NotificationService;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Contracts\EventDispatcher\Event;

class NotifyUserOnOrderStatusUpdateListener
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function onOrderStatusUpdate(OrderStatusUpdateEvent $event): void
    {
        $this->notificationService->setNotification(new OrderUpdateStatusNotification($event->getOrder(), $this->getUser()))
            ->notify();
    }

    /**
     * Assume that it's a real user from database.
     * @return \stdClass
     */
    private function getUser(): \stdClass
    {
        $user = new \stdClass;
        $user->name = 'CustomerName';
        $user->email = 'customer@gmail.com';
        $user->mobile = '0989307864477';
        $user->slack_channel = 'https://myslackchannel.com';
        $user->preferredChannels = [
            'sms', 'email', 'slack'
        ];
        return $user;
    }
}