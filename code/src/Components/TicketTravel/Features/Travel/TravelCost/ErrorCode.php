<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\TravelCost;

enum ErrorCode: int
{
    case FAILED_TO_CREATE_TRAVEL_COST = 20601;
    case TRAVEL_COST_ALREADY_EXISTS = 20602;
    case FAILED_TO_UPDATE_TRAVEL_COST = 20603;
    case FAILED_TO_READ_TRAVEL_COST = 20604;
}
