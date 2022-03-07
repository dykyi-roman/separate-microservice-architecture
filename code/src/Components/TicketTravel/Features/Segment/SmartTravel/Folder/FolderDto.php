<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder;

/**
 * @psalm-immutable
 */
final class FolderDto
{
    public function __construct(
        public readonly int $id,
        public readonly int $queryId,
        public readonly string $title,
        public readonly array $textConditions,
        public readonly array $numberConditions,
        public readonly array $filterConditions
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            (int) $data['id'],
            (int) $data['queryEntity']['id'],
            (string) $data['title'],
            (array) $data['queryEntity']['textConditions'],
            (array) $data['queryEntity']['numberConditions'],
            (array) $data['queryEntity']['filterConditions'],
        );
    }
}
