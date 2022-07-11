<?php

namespace App\ValidationRule;

use App\Enum\OrderStatus;

class OrderValidStatusRule extends OrderBaseRule
{
    const MESSAGE = 'Given status is not valid!';

    public function execute(): bool
    {
        return in_array($this->order->getStatus(), array_column(OrderStatus::cases(), 'value'));
    }
}