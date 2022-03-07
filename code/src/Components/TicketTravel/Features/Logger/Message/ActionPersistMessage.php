<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Logger\Message;

/**
 * @see \Travel\Components\TicketTravel\Features\Logger\Message\ActionPersistMessageHandler
 */
final class ActionPersistMessage
{
    public function __construct(public readonly string $request, public readonly array $payload)
    {
    }
}
