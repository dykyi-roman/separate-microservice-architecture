<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Read;

/**
 * @psalm-immutable
 */
final class Responder
{
    public function __invoke(SegmentDto $segmentDto): array
    {
        return [
            'queryId' => $segmentDto->queryId,
            'title' => $segmentDto->title,
            'conditions' => $segmentDto->conditions,
        ];
    }
}
