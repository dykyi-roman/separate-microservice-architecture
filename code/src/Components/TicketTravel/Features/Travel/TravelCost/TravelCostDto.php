<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\TravelCost;

use JsonSerializable;

/**
 * @psalm-immutable
 */
final class TravelCostDto implements JsonSerializable
{
    public function __construct(
        public readonly int $id,
        public readonly int $tariffId,
        public readonly string $name,
        public readonly float $limit,
        public readonly float $price,
        public readonly int $smartFolderId,
        public readonly string $locationZoneId,
        public readonly string $locationZoneTitle,
        public readonly int $status,
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
            (int) $data['tariff']['id'],
            $data['name'],
            (float) $data['limit'],
            (float) $data['price'],
            (int) $data['goodsSegmentId'],
            $data['zoneMapId'],
            $data['zoneMapTitle'],
            (int) $data['status'],
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
            'tariffId' => $this->tariffId,
            'name' => $this->name,
            'limit' => $this->limit,
            'price' => $this->price,
            'smartFolderId' => $this->smartFolderId,
            'locationZoneId' => $this->locationZoneId,
            'locationZoneTitle' => $this->locationZoneTitle,
            'status' => $this->status,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
