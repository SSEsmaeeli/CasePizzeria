<?php

namespace App\Validator;

use App\ValidationRule\OrderExistsRule;
use App\ValidationRule\OrderValidStatusRule;

class OrderValidator extends OrderBaseValidator
{
    protected array $validationRules = [
        OrderExistsRule::class,
        OrderValidStatusRule::class
    ];
}