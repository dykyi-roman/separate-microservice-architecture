<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Update;

/**
 * @psalm-immutable
 */
final class Responder
{
    public function __invoke(SegmentDto $segmentDto): array
    {
        return [
            'title' => $segmentDto->title,
            'conditionIds' => $segmentDto->conditionIds,
        ];
    }
}
