<?php

namespace App\Validator;

use App\ValidationRule\OrderExistsRule;

class OrderStoreValidator extends OrderBaseValidator
{
    protected array $validationRules = [
        OrderExistsRule::class,
    ];
}