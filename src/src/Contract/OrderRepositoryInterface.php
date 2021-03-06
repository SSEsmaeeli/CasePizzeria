<?php

namespace App\Contract;

use App\Entity\Order;

interface OrderRepositoryInterface
{
    public function store(Order $order): void;

    public function get(): array;

    public function findById($orderId);

    public function update(): void;
}