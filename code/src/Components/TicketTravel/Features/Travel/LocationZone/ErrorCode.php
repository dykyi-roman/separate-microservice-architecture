<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\LocationZone;

enum ErrorCode: int
{
    case LOCATION_ZONE_NOT_FOUND_BY_ID = 20401;
    case LOCATION_ZONE_NOT_FOUND_BY_NAME = 20402;
    case LOCATION_ZONE_NAME_IS_EMPTY = 20403;
}
