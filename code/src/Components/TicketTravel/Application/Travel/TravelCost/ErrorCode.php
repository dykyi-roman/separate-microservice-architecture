<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\TravelCost;

enum ErrorCode: int
{
    case NAME_MIN_LENGTH = 10601;
    case NAME_MAX_LENGTH = 10602;
    case INVALID_UUID = 10603;
}
