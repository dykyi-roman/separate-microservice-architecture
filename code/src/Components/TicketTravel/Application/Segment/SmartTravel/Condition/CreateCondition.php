<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Type;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\ConditionException;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\ConditionManager;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum\FieldGoods;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type\FilterCondition;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type\FilterValue;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type\NumberCondition;

final class CreateCondition implements ConditionManagerInterface
{
    public function __construct(private ConditionManager $condition)
    {
    }

    public function execute(int $queryId, Condition $condition): int|null
    {
        try {
            return $this->match($queryId, $condition);
        } catch (ConditionException) {
            return null;
        }
    }

    private function match(int $queryId, Condition $condition): int
    {
        if (null === $condition->type) {
            throw Type::typeNotSupportedException();
        }

        return match ($condition->type) {
            Type::CATEGORY => $this->condition->createFilter(
                $queryId,
                new FilterCondition(new FilterValue((int) $condition->value, $condition->value))
            ),
            Type::ORDER => $this->condition->createNumber(
                $queryId,
                new NumberCondition(FieldGoods::from(FieldGoods::GOODS_SLA_ID->value), (int) $condition->value)
            ),
            Type::SELLER => $this->condition->createNumber(
                $queryId,
                new NumberCondition(FieldGoods::from(FieldGoods::GOODS_SELLER_ID->value), (int) $condition->value)
            ),
        };
    }
}
