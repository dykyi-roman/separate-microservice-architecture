<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\LocationZone;

enum ErrorCode: int
{
    case VALUE_NOT_DEFINED = 10401;
    case VALUE_TYPE_IS_WRONG = 10402;
    case TEXT_MIN_LENGTH = 10403;
    case TEXT_MAX_LENGTH = 10404;
}
