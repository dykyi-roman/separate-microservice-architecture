<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\List;

use Travel\Components\TicketTravel\Features\Travel\Travel\TravelDto;
use Travel\Components\TicketTravel\Features\Travel\Travel\TravelListDto;

final class Responder
{
    public function __invoke(TravelListDto $dto): array
    {
        $pagination = $dto->pagination;

        return [
            'items' => array_map(static fn (TravelDto $tariffDto): array => $tariffDto->jsonSerialize(), $dto->items),
            'pagination' => $pagination->jsonSerialize(),
        ];
    }
}
