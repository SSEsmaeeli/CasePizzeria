<?php

declare(strict_types=1);

namespace App\Contract;

interface PizzaRepositoryInterface
{
    public function get(): array;

    public function findById($pizzaId);
}