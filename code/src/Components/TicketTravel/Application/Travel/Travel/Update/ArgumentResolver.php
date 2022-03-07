<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\Update;

use Travel\Components\TicketTravel\Application\Travel\Travel\ErrorCode;
use Travel\Components\TicketTravel\Application\Travel\ValidationAssert;
use Travel\Components\TicketTravel\Features\Travel\DeliveryMethod;
use Travel\Components\TicketTravel\Features\Travel\DeliveryService;

final class ArgumentResolver
{
    private const MIN_LENGTH_SIZE = 1;
    private const MAX_LENGTH_SIZE = 255;

    public readonly int $id;
    public readonly string $name;
    public readonly string $methodId;
    public readonly string $serviceId;
    public readonly int $status;

    public function __construct(array $arguments)
    {
        $length = mb_strlen($arguments['name']);
        ValidationAssert::lessThan($length, self::MAX_LENGTH_SIZE, ErrorCode::NAME_MAX_LENGTH->value);
        ValidationAssert::greaterThan($length, self::MIN_LENGTH_SIZE, ErrorCode::NAME_MIN_LENGTH->value);

        DeliveryMethod::supported($arguments['methodId'], ErrorCode::TRAVEL_METHOD_NOT_SUPPORTED->value);

        $serviceId = trim($arguments['serviceId'], ' ');
        DeliveryService::supported($serviceId, ErrorCode::TRAVEL_SERVICE_NOT_SUPPORTED->value);

        $this->id = (int) $arguments['id'];
        $this->name = trim($arguments['name'], ' ');
        $this->methodId = $arguments['methodId'];
        $this->serviceId = $serviceId;
        $this->status = (int) $arguments['status'];
    }
}
