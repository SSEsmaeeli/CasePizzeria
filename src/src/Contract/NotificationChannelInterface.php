<?php

namespace App\Contract;

interface NotificationChannelInterface
{
    public function send(): void;

    public function setData(array $data): static;
}