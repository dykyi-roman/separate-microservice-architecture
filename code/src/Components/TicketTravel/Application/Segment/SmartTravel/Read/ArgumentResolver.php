<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Read;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\ErrorCode;
use Travel\Components\TicketTravel\Application\Segment\ValidationAssert;

final class ArgumentResolver
{
    public readonly int $travelId;

    public function __construct(array $arguments)
    {
        ValidationAssert::keyExists($arguments, 'id', ErrorCode::TRAVEL_ID_NOT_DEFINED->value);
        ValidationAssert::isId($arguments['id'], ErrorCode::TRAVEL_ID_NOT_DEFINED->value);

        $this->travelId = (int) $arguments['id'];
    }
}
