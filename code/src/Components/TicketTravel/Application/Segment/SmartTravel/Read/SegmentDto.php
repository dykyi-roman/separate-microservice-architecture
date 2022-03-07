<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Read;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Condition;

/**
 * @psalm-suppress InvalidPropertyAssignmentValue
 */
final class SegmentDto
{
    public readonly array $conditions;

    public function __construct(public readonly int $queryId, public readonly string $title, Condition ...$conditions)
    {
        $this->conditions = array_map(
            static fn (Condition $condition): array => Condition::fromConditionToArray($condition),
            $conditions,
        );
    }
}
