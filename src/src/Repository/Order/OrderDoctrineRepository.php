<?php

namespace App\Repository\Order;

use App\Contract\OrderRepositoryInterface;
use App\Entity\Order;
use Doctrine\Persistence\ManagerRegistry;

class OrderDoctrineRepository implements OrderRepositoryInterface
{
    private $entityManager;

    private $driver;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->entityManager = $doctrine->getManager();
        $this->driver = $doctrine->getRepository(Order::class);
    }

    public function get(): array
    {
        return $this->driver->findAll();
    }

    public function store(Order $order): void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }
}