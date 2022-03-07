<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\Create;

use Travel\Components\TicketTravel\Application\Travel\Travel\ErrorCode;
use Travel\Components\TicketTravel\Application\Travel\ValidationAssert;
use Travel\Components\TicketTravel\Features\Travel\DeliveryMethod;
use Travel\Components\TicketTravel\Features\Travel\DeliveryService;
use Travel\Components\TicketTravel\Features\Travel\DeliveryStrategy;

final class ArgumentResolver
{
    private const MIN_LENGTH_SIZE = 1;
    private const MAX_LENGTH_SIZE = 255;

    public readonly int $status;
    public readonly string $name;
    public readonly string $methodId;
    public readonly string $serviceId;
    public readonly string $strategy;

    public function __construct(array $arguments)
    {
        $length = mb_strlen($arguments['name']);
        ValidationAssert::lessThan($length, self::MAX_LENGTH_SIZE, ErrorCode::NAME_MAX_LENGTH->value);
        ValidationAssert::greaterThan($length, self::MIN_LENGTH_SIZE, ErrorCode::NAME_MIN_LENGTH->value);

        $strategy = strtolower(trim($arguments['strategy'], ' '));
        DeliveryStrategy::supported($strategy, ErrorCode::TRAVEL_STRATEGY_NOT_SUPPORTED->value);

        DeliveryMethod::supported($arguments['methodId'], ErrorCode::TRAVEL_METHOD_NOT_SUPPORTED->value);

        $serviceId = trim($arguments['serviceId'], ' ');
        DeliveryService::supported($serviceId, ErrorCode::TRAVEL_SERVICE_NOT_SUPPORTED->value);

        $this->name = trim($arguments['name'], ' ');
        $this->methodId = $arguments['methodId'];
        $this->serviceId = $serviceId;
        $this->strategy = $strategy;
        $this->status = (int) $arguments['status'];
    }
}
