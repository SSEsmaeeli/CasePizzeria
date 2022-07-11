<?php

namespace App\Validator;

use App\Entity\Order;
use App\ValidationRule\OrderExistsRule;
use App\ValidationRule\OrderValidStatusRule;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderValidator
{
    private array $validationRules = [
        OrderExistsRule::class,
        OrderValidStatusRule::class
    ];

    protected Order $order;
    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator, Order $order)
    {
        $this->validator = $validator;
        $this->order = $order;
    }

    public function validate()
    {
        foreach ($this->validationRules as $ruleClassName) {
            $rule = (new $ruleClassName($this->validator));

            $rule->setOrder($this->order)
                ->execute() ? '' :
                throw new \Exception($rule->getMessage());
        }
    }
}