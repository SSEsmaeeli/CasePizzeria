<?php

namespace App\Service;

use App\Contract\OrderRepositoryInterface;

class OrderStatusUpdater
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(): void
    {
        $this->orderRepository->update();
    }
}