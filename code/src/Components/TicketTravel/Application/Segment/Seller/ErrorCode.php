<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\Seller;

enum ErrorCode: int
{
    case VALUE_NOT_DEFINED = 10201;
    case VALUE_TYPE_IS_WRONG = 10202;
    case ID_NOT_VALID = 10203;
    case TEXT_MIN_LENGTH = 10204;
    case TEXT_MAX_LENGTH = 10205;
    case START_FROM_SPECIAL_SYMBOL = 10206;
}
