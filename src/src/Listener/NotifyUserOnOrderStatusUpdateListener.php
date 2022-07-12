<?php

namespace App\Listener;

use App\Event\OrderStatusUpdateEvent;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Contracts\EventDispatcher\Event;

class NotifyUserOnOrderStatusUpdateListener
{
    #[NoReturn] public function onOrderStatusUpdate(OrderStatusUpdateEvent $event): void
    {
        dd('listener triggered', $event->getOrder());
        // @todo send notification..
    }
}