<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\Read;

use Travel\Components\TicketTravel\Features\Travel\Travel\TravelDto;

final class Responder
{
    public function __invoke(TravelDto $dto): array
    {
        return $dto->jsonSerialize();
    }
}
