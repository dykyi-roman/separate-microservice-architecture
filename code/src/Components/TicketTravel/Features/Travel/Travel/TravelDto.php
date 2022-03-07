<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

use Travel\Components\TicketTravel\Features\Travel\DeliveryMethod;
use Travel\Components\TicketTravel\Features\Travel\DeliveryService;
use Travel\Components\TicketTravel\Features\Travel\DeliveryStrategy;
use Travel\Components\TicketTravel\Features\Travel\Status;
use JsonSerializable;

final class TravelDto implements JsonSerializable
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly NamedIdDto $service,
        public readonly NamedIdDto $method,
        public readonly NamedIdDto $strategy,
        public readonly NamedIdDto $status,
        public readonly string $createdBy,
        public readonly string $updatedBy,
        public readonly string $createdAt,
        public readonly string $updatedAt,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            (int) $data['id'],
            $data['name'],
            new NamedIdDto($data['serviceId'] ?? null, DeliveryService::name($data['serviceId'] ?? null)),
            new NamedIdDto($data['methodMapId'] ?? null, DeliveryMethod::name($data['methodMapId'] ?? null)),
            new NamedIdDto($data['strategy'], DeliveryStrategy::name($data['strategy'])),
            new NamedIdDto((string) $data['status'], Status::name((int) $data['status'])),
            $data['createdBy'],
            $data['updatedBy'],
            $data['createdAt'],
            $data['updatedAt'],
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'service' => $this->service->jsonSerialize(),
            'method' => $this->method->jsonSerialize(),
            'strategy' => $this->strategy,
            'status' => $this->status,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
