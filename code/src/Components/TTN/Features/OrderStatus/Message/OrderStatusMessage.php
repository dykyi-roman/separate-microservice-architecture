<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Features\OrderStatus\Message;

final class OrderStatusMessage
{
    public function __construct(public readonly int $orderId, public readonly int $status)
    {
    }
}
