<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Update;

/**
 * @psalm-immutable
 */
final class SegmentDto
{
    public function __construct(public readonly null|string $title, public readonly null|array $conditionIds)
    {
    }
}
