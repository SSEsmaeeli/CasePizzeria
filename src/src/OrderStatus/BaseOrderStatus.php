<?php

namespace App\OrderStatus;

class BaseOrderStatus
{
    const ACTIONS = [];

    const NEXT = '';

    public function actions(): array
    {
        return $this->getActions();
    }

    public function next(): string
    {
        return $this->getNext();
    }

    public function getValue(): string
    {
        return static::VALUE;
    }

    protected function getActions(): array
    {
        return static::ACTIONS ?? [];
    }

    protected function getNext()
    {
        return static::NEXT ?? '';
    }
}