<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Delete;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Type;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\ConditionManager;

final class Resolver
{
    public function __construct(private ConditionManager $condition)
    {
    }

    public function __invoke(ArgumentResolver $argResolver): bool
    {
        match ($argResolver->type) {
            Type::CATEGORY => $this->condition->deleteFilter($argResolver->queryId, $argResolver->conditionId),
            Type::ORDER, Type::SELLER => $this->condition->deleteCondition(
                $argResolver->queryId,
                $argResolver->conditionId,
                'NumberCondition'
            ),
        };

        return true;
    }
}
