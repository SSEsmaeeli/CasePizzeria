<?php

namespace App\Validator;

use App\ValidationRule\OrderExistsRule;

class OrderStoreValidator
{
    protected array $validationRules = [
        OrderExistsRule::class,
    ];
}