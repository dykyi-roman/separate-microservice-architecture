<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Create;

use JsonSerializable;

/**
 * @psalm-immutable
 */
final class SegmentDto implements JsonSerializable
{
    public function __construct(
        public readonly int $travelId,
        public readonly int $queryId,
        public readonly array $conditionIds
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'smartFolderId' => $this->travelId,
            'queryId' => $this->queryId,
            'conditionIds' => $this->conditionIds,
        ];
    }
}
