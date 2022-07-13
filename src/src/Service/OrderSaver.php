<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\OrderRepositoryInterface;
use App\Contract\PizzaRepositoryInterface;
use App\Entity\Order;
use App\Enum\OrderStatus;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderSaver
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle($order)
    {
        $this->orderRepository->store($order);
    }
}
