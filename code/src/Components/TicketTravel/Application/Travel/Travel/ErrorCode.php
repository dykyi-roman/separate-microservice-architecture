<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel;

enum ErrorCode: int
{
    case TRAVEL_SERVICE_NOT_SUPPORTED = 10500;
    case TRAVEL_METHOD_NOT_SUPPORTED = 10501;
    case TRAVEL_STRATEGY_NOT_SUPPORTED = 10502;
    case NAME_MIN_LENGTH = 10503;
    case NAME_MAX_LENGTH = 10504;
    case PAGE_MIN_LENGTH = 10505;
    case ITEMS_PER_PAGE_MIN_LENGTH = 10506;
    case ITEMS_PER_PAGE_MAX_LENGTH = 10507;
}
