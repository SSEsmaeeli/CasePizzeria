<?php

namespace App\NotificationChannel;

use App\Contract\NotificationChannelInterface;

class SlackChannel extends BaseChannel implements NotificationChannelInterface
{
    public function send(): void
    {
//        dd($this->data);
        var_dump('slack message is sent!');
        // TODO: Implement handle() method.
    }
}