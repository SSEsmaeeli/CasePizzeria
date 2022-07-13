<?php

namespace App\OrderStatus;

class PizzaVoorbereid extends BaseOrderStatus
{
    const VALUE = 'Pizza voorbereid';

    const NEXT = InDeOven::VALUE;

    const ACTIONS = [
        InDeOven::VALUE,
        Cancelled::VALUE
    ];
}