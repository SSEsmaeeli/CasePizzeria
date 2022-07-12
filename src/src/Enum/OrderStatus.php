<?php

namespace App\Enum;

enum OrderStatus: string
{
    case BESTELLING_ONTVANGEN = 'Bestelling ontvangen';
    case PIZZA_VOORBEREID = 'Pizza voorbereid';
    case IN_DE_OVEN = 'In de oven';
    case BEZORGER_ONDERWEG = 'Bezorger onderweg';
    case AFGELEVERD = 'Afgeleverd';
}