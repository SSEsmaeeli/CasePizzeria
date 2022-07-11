<?php

namespace App\ValidationRule;

class OrderExistsRule extends OrderBaseRule
{
    const MESSAGE = 'Order doesnt exists!';

    public function execute(): bool
    {
        return ! count($this->validator->validate($this->order));
    }
}