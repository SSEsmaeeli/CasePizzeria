<?php

namespace App\Repository\Pizza;

use App\Contract\PizzaRepositoryInterface;
use App\Entity\Pizza;
use Doctrine\Persistence\ManagerRegistry;

class PizzaDoctrineRepository implements PizzaRepositoryInterface
{
    private $driver;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->driver = $doctrine->getRepository(Pizza::class);
    }

    public function get(): array
    {
        return $this->driver->findAll();
    }

    public function findById($pizzaId)
    {
        return $this->driver->findOneBy(['id' => $pizzaId]);
    }
}