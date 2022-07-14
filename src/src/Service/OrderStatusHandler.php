<?php

namespace App\Service;

use App\OrderStatus\Afgeleverd;
use App\OrderStatus\BestellingOntvangen;
use App\OrderStatus\BezorgerOnderweg;
use App\OrderStatus\Cancelled;
use App\OrderStatus\InDeOven;
use App\OrderStatus\PizzaVoorbereid;

class OrderStatusHandler
{
    const STATUS_NOT_VALID = 'Status is not valid';

    const STATUS_MAP = [
        Afgeleverd::VALUE => Afgeleverd::class,
        BestellingOntvangen::VALUE => BestellingOntvangen::class,
        BezorgerOnderweg::VALUE => BezorgerOnderweg::class,
        Cancelled::VALUE => Cancelled::class,
        InDeOven::VALUE => InDeOven::class,
        PizzaVoorbereid::VALUE => PizzaVoorbereid::class
    ];

    private string $status;

    public $statusInstance;

    public function setStatus(string $status): static
    {
        $this->status = $status;
        $this->getClass();
        return $this;
    }

    public function getStatusInstance()
    {
        return $this->statusInstance;
    }

    private function getClass()
    {
        $statusClassName = self::STATUS_MAP[$this->status] ?? throw new \Exception(self::STATUS_NOT_VALID);

        $this->statusInstance = (new $statusClassName);
    }
}