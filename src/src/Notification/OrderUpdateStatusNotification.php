<?php

namespace App\Notification;

use App\Entity\Order;
use App\Notification\BaseNotification;

class OrderUpdateStatusNotification extends BaseNotification
{
    private Order $order;

    private object $user;

    public function __construct(Order $order, $receiver)
    {
        $this->order = $order;
        $this->user = $receiver;
        parent::__construct();
    }

    public function setMessage(): void
    {
        $this->message = 'Hi, you order is on '. $this->order->getStatus();
    }

    public function setPreferredChannelStrings()
    {
        $this->preferredChannelStrings = (array)$this->user->preferredChannels;
    }

    protected function withMoreData(): array
    {
        return [
            'more_data' => 'yes',
            'hi' => 'no!'
        ];
    }
}