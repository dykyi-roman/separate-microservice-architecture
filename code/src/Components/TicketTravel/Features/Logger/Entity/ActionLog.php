<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Logger\Entity;

use DateTimeImmutable;

final class ActionLog
{
    /* @phpstan-ignore-next-line */
    public readonly int $id;

    public function __construct(
        public readonly string $project,
        public readonly string $method,
        public readonly array $client,
        public readonly array $data,
        public readonly DateTimeImmutable $createdAt,
    ) {
    }
}
