<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type;

use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum\Entity;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum\Equal;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum\FieldGoods;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum\Operator;

/**
 * @psalm-immutable
 */
final class TextCondition implements ConditionInterface
{
    public function __construct(private FieldGoods $fieldGoods, private string $text)
    {
    }

    public function __toString(): string
    {
        return sprintf(
            '{condition: %s, operator: %s, entity: %s, fieldGoods: %s, value: "%s"}',
            Equal::YES->value,
            Operator::AND_OPERATOR->value,
            Entity::GOODS->value,
            $this->fieldGoods->value,
            $this->text
        );
    }
}
