<?php

namespace App\ValidationRule;

use App\Entity\Order;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class OrderBaseRule
{
    protected Order $order;

    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function setOrder(Order $order): static
    {
        $this->order = $order;
        return $this;
    }

    public function getMessage(): string
    {
        return static::MESSAGE;
    }

    abstract public function execute(): bool;
}