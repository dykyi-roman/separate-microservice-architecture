<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

use JsonSerializable;

final class NamedIdDto implements JsonSerializable
{
    public function __construct(public readonly ?string $id, public readonly ?string $name)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
