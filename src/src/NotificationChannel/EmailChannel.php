<?php

namespace App\NotificationChannel;

use App\Contract\NotificationChannelInterface;

class EmailChannel extends BaseChannel implements NotificationChannelInterface
{
    public function send(): void
    {
        var_dump('email is sent!');
        // TODO: Implement handle() method.
    }
}