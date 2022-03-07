<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum;

enum Operator: string
{
    case AND_OPERATOR = 'ALL';
    case OR_OPERATOR = 'ANY_ONE';
}
