<?php

namespace App\Contract;

use App\Entity\Order;

interface OrderRepositoryInterface
{
    public function store(Order $order): void;
}