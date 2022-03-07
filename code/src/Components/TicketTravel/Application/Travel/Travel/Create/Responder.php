<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\Create;

/**
 * @psalm-immutable
 */
final class Responder
{
    public function __invoke(array $data): array
    {
        return $data;
    }
}
