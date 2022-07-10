<?php

namespace App\Enum;

enum OrderStatus: string
{
    case BestellingOntvangen = 'Bestelling ontvangen';
    case PizzaVoorbereid = 'Pizza voorbereid';
    case InDeOven = 'In de oven';
    case BezorgerOnderweg = 'Bezorger onderweg';
    case Afgeleverd = 'Afgeleverd';
}