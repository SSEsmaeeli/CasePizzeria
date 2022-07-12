<?php

namespace App\Service;

use App\Entity\Order;

class NotificationService
{
    private $notification;

    public function notify()
    {
        foreach ($this->notification->getChannels() as $channel) {
            (new $channel)
                ->setData($this->notification->getData())
                ->send();
        }
    }

    public function setNotification($notification): static
    {
        $this->notification = $notification;
        return $this;
    }
}