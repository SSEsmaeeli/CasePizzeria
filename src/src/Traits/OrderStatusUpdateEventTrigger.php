<?php

namespace App\Traits;

use App\Entity\Order;
use App\Event\OrderStatusUpdateEvent;
use App\Listener\NotifyUserOnOrderStatusUpdateListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

trait OrderStatusUpdateEventTrigger
{
    public function triggerOrderStatusUpdate(Order $order): void
    {
        $dispatcher = new EventDispatcher();
        $listener = new NotifyUserOnOrderStatusUpdateListener();
        $dispatcher->addListener(OrderStatusUpdateEvent::NAME, [$listener, 'onOrderStatusUpdate']);
        $dispatcher->dispatch(new OrderStatusUpdateEvent($order), OrderStatusUpdateEvent::NAME);
    }
}