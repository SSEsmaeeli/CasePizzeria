<?php

namespace App\Validator;

use App\Entity\Order;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderBaseValidator
{
    protected Order $order;
    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator, Order $order)
    {
        $this->validator = $validator;
        $this->order = $order;
    }

    public function validate()
    {
        foreach ($this->getValidationRules() as $ruleClassName) {
            $rule = (new $ruleClassName($this->validator));

            $rule->setOrder($this->order)
                ->execute() ? '' :
                throw new \Exception($rule->getMessage());
        }
    }

    private function getValidationRules(): array
    {
        return property_exists($this, 'validationRules') ? $this->validationRules : [];
    }
}