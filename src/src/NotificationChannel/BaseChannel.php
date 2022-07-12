<?php

namespace App\NotificationChannel;

class BaseChannel
{
    protected array $data;

    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }
}