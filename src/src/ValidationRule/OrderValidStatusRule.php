<?php

namespace App\ValidationRule;

use App\Enum\OrderStatus;

class OrderValidStatusRule extends OrderBaseRule
{
    const MESSAGE = 'Given status is not valid!';

    public function execute(): bool
    {
        return in_array(
            $this->order->getStatus(),
            $this->getAvailableActions()
        );

        // old method (Non-Sequential):
        // use $this->getAllActions() instead of $this->getAvailableActions()
    }

    public function getAvailableActions(): array
    {
        return $this->order->getActions();
    }

    public function getAllActions(): array
    {
        return array_column(OrderStatus::cases(), 'value');
    }
}