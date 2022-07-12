<?php

namespace App\NotificationChannel;

use App\Contract\NotificationChannelInterface;

class SmsChannel extends BaseChannel implements NotificationChannelInterface
{
    public function send(): void
    {
        var_dump('sms is sent');
        // TODO: Implement handle() method.
    }
}