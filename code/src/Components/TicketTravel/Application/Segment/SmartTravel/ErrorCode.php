<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel;

enum ErrorCode: int
{
    case TRAVEL_TITLE_NOT_DEFINED = 10301;
    case TRAVEL_TITLE_MIN_LENGTH = 10302;
    case TRAVEL_TITLE_MAX_LENGTH = 10303;
    case CONDITIONS_NOT_DEFINED = 10304;
    case CONDITIONS_NOT_ARRAY = 10305;
    case CONDITIONS_IS_EMPTY = 10306;
    case CONDITION_ID_NOT_VALID = 10307;
    case CONDITION_VALUE_NOT_VALID = 10308;
    case CONDITION_TYPE_NOT_VALID = 10309;
    case TRAVEL_ID_NOT_DEFINED = 10310;
    case QUERY_ID_NOT_DEFINED = 10311;
}
