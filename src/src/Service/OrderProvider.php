<?php

namespace App\Service;

use App\Contract\OrderRepositoryInterface;
use App\Entity\Order;

class OrderProvider
{
    private OrderRepositoryInterface $orderRepository;

    private Order $order;

    private string $requestedStatus;

    private int $orderId;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function setData($orderId, $status): static
    {
        $this->orderId = $orderId;
        $this->requestedStatus = $status;
        return $this;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function prepare(): static
    {
        $this->order = $this->orderRepository->findById($this->orderId);
        $this->order->setStatus($this->requestedStatus);
        return $this;
    }
}