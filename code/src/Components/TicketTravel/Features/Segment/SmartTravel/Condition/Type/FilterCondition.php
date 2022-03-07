<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type;

/**
 * @psalm-immutable
 */
final class FilterCondition implements ConditionInterface
{
    /** @var FilterValue[] */
    private array $filterValueList;

    public function __construct(FilterValue ...$filterValueList)
    {
        $this->filterValueList = $filterValueList;
    }

    public function filterValueList(): array
    {
        return $this->filterValueList;
    }

    public function __toString(): string
    {
        return implode(
            ',',
            array_map(static fn (FilterValue $value): string => (string) $value, $this->filterValueList)
        );
    }
}
