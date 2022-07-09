<?php

declare(strict_types=1);

namespace App\Notifier;

interface NotificationHandlerInterface
{
    public function handle($notification): void;
}
