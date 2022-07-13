<?php

namespace App\OrderStatus;

class BestellingOntvangen extends BaseOrderStatus
{
    const VALUE = 'Bestelling ontvangen';

    const NEXT = PizzaVoorbereid::VALUE;

    const ACTIONS = [
        PizzaVoorbereid::VALUE,
        Cancelled::VALUE
    ];
}