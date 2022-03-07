<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition;

use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\ConditionManager;

/**
 * @psalm-immutable
 */
final class ConditionFactory
{
    public function __construct(private ConditionManager $conditionManager)
    {
    }

    public function create(bool $create): ConditionManagerInterface
    {
        return match ($create) {
            true => new CreateCondition($this->conditionManager),
            false => new UpdateCondition($this->conditionManager),
        };
    }
}
