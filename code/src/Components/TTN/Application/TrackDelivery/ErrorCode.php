<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Application\TrackDelivery;

enum ErrorCode: int
{
    case EXTERNAL_NUMBER_FIELD_IS_EMPTY = 10701;
    case WRONG_INCOMING_PARAMETERS = 10702;
    case INVALID_UUID = 10703;
}
