<?php

declare(strict_types=1);

namespace App\Order;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\Persistence\ManagerRegistry;

class OrderSaver
{
    private $orderRepository;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->orderRepository = $doctrine->getRepository(Order::class);
    }

    public function handle()
    {

    }

    public function setData($request)
    {
//        $this->orderRepository->
        return $this;
    }

    public function validate()
    {
        return $this;
    }
}
