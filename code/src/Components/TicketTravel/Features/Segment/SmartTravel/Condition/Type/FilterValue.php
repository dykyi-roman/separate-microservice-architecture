<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type;

/**
 * @psalm-immutable
 */
final class FilterValue implements ConditionInterface
{
    public function __construct(private int $value, private string $valueTitle)
    {
    }

    public function __toString(): string
    {
        return sprintf(
            '{value: "%d", valueTitle: "%s"}',
            $this->value,
            $this->valueTitle,
        );
    }
}
