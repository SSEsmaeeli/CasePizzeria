<?php

namespace App\Service;

use App\Contract\OrderRepositoryInterface;
use App\Contract\PizzaRepositoryInterface;
use App\Entity\Order;
use App\Entity\Pizza;
use App\Enum\OrderStatus;

class OrderProvider
{
    private OrderRepositoryInterface $orderRepository;

    private PizzaRepositoryInterface $pizzaRepository;

    private Order $order;

    public function __construct(OrderRepositoryInterface $orderRepository, PizzaRepositoryInterface $pizzaRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->pizzaRepository = $pizzaRepository;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function createOrder($request): static
    {
        $order = new Order();
        $order->setBodem($request->get('bodem'));
        $order->setTopping($request->get('topping'));
        $order->setStatus(OrderStatus::BESTELLING_ONTVANGEN->value);
        $order->setPizza($this->getPizzaInstance($request->get('pizza_id')));
        $this->order = $order;
        return $this;
    }

    public function findOrder($orderId): static
    {
        $this->order = $this->orderRepository->findById($orderId);
        return $this;
    }

    public function setOrderStatus($status): static
    {
        $this->order->setStatus($status);
        return $this;
    }

    private function getPizzaInstance($pizzaId)
    {
        return $this->pizzaRepository->findById($pizzaId);
    }
}