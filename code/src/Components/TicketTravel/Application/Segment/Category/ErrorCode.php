<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\Category;

enum ErrorCode: int
{
    case VALUE_NOT_DEFINED = 10101;
    case VALUE_TYPE_IS_WRONG = 10102;
    case ID_NOT_VALID = 10103;
    case TEXT_MIN_LENGTH = 10104;
    case TEXT_MAX_LENGTH = 10105;
    case START_FROM_SPECIAL_SYMBOL = 10106;
}
