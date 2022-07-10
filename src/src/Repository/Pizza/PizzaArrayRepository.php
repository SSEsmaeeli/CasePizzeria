<?php

namespace App\Repository\Pizza;

use App\Contract\PizzaRepositoryInterface;

class PizzaArrayRepository implements PizzaRepositoryInterface
{
    private $data = [
        [
            'id' => 1,
            'name' => 'Dominos'
        ],[
            'id' => 2,
            'name' => 'New York Pizza'
        ],[
            'id' => 3,
            'name' => 'Pepperoni Pizza'
        ],[
            'id' => 4,
            'name' => 'Meat Pizza'
        ]
    ];

    public function get(): array
    {
        return $this->getData();
    }

    public function findById($pizzaId): array
    {
        return $this->getData()[0];
    }

    private function getData(): array
    {
        return $this->data;
    }
}