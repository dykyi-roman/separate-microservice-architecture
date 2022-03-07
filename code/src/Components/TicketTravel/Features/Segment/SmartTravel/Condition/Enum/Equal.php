<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum;

enum Equal: string
{
    case YES = 'EQUAL';
    case NOT = 'NOT_EQUAL';
}
