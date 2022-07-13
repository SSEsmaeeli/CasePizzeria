<?php

namespace App\OrderStatus;

class InDeOven extends BaseOrderStatus

{
    const VALUE = 'In de oven';

    const NEXT = BezorgerOnderweg::VALUE;

    const ACTIONS = [
        BezorgerOnderweg::VALUE,
        Cancelled::VALUE
    ];
}