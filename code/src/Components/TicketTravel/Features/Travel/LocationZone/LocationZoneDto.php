<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\LocationZone;

use Symfony\Component\Uid\Uuid;

/**
 * @psalm-immutable
 */
final class LocationZoneDto
{
    public function __construct(public readonly Uuid $id, public readonly string $name, public readonly bool $active)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(Uuid::fromString($data['id']), $data['nameUa'], 'Активно' === $data['status']['nameUa']);
    }
}
