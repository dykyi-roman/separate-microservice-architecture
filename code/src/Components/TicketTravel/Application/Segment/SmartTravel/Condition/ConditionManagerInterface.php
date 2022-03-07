<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition;

interface ConditionManagerInterface
{
    public function execute(int $queryId, Condition $condition): int|null;
}
