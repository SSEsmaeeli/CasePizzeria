<?php

namespace App\Repository\Order;

use App\Contract\OrderRepositoryInterface;
use App\Entity\Order;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class OrderDoctrineRepository implements OrderRepositoryInterface
{
    private ObjectManager $entityManager;

    private $driver;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->entityManager = $doctrine->getManager();
        $this->driver = $doctrine->getRepository(Order::class);
    }

    public function get(): array
    {
        $orders = $this->driver->findAll();

        foreach($orders as $order) {
            $order->setStatusStuff();
        }

        return $orders;
    }

    public function store(Order $order): void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }

    public function update(): void
    {
        $this->entityManager->flush();
    }

    public function findById($orderId)
    {
        $order = $this->driver->findOneBy(['id' => $orderId]);
        $order->setStatusStuff();
        return $order;
    }
}