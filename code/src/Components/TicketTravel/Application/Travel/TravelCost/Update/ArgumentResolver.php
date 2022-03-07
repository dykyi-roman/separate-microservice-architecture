<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\TravelCost\Update;

use Travel\Components\TicketTravel\Application\Travel\TravelCost\ErrorCode;
use Travel\Components\TicketTravel\Application\Travel\ValidationAssert;
use Symfony\Component\Uid\Uuid;

final class ArgumentResolver
{
    private const MIN_LENGTH_SIZE = 1;
    private const MAX_LENGTH_SIZE = 255;

    public readonly int $id;
    public readonly string $name;
    public readonly float $limit;
    public readonly float $price;
    public readonly int $status;
    public readonly int $smartFolderId;
    public readonly Uuid $locationZoneId;

    public function __construct(array $arguments)
    {
        $length = mb_strlen(trim($arguments['name'], ' '));
        ValidationAssert::lessThan($length, self::MAX_LENGTH_SIZE, ErrorCode::NAME_MAX_LENGTH->value);
        ValidationAssert::greaterThan($length, self::MIN_LENGTH_SIZE, ErrorCode::NAME_MIN_LENGTH->value);

        ValidationAssert::uuid(trim($arguments['locationZoneId'], ' '), ErrorCode::INVALID_UUID->value);

        $this->id = (int) $arguments['id'];
        $this->name = trim($arguments['name'], ' ');
        $this->smartFolderId = (int) $arguments['smartFolderId'];
        $this->locationZoneId = Uuid::fromString(trim($arguments['locationZoneId'], ' '));
        $this->limit = (float) $arguments['limit'];
        $this->price = (float) $arguments['price'];
        $this->status = (int) $arguments['status'];
    }
}
