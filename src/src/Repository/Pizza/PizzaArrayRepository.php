<?php

namespace App\Repository\Pizza;

use App\Contract\PizzaRepositoryInterface;

class PizzaArrayRepository implements PizzaRepositoryInterface
{
    private $data = [
        [
            'id' => 1,
            'name' => 'Dominosssss'
        ],[
            'id' => 2,
            'name' => 'New York Pizzaa'
        ]
    ];

    public function get(): array
    {
        return $this->getData();
    }

    public function findById($pizzaId)
    {

    }

    private function getData(): array
    {
        return $this->data;
    }
}