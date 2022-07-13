<?php

namespace App\OrderStatus;

class BezorgerOnderweg extends BaseOrderStatus
{
    const VALUE = 'Bezorger onderweg';

    const NEXT = Afgeleverd::VALUE;

    const ACTIONS = [
        Afgeleverd::VALUE,
        Cancelled::VALUE
    ];
}