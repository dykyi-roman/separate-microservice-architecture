<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Features\TrackDelivery;

use JsonSerializable;
use Symfony\Component\Uid\Uuid;

final class ExpressNote implements JsonSerializable
{
    public function __construct(
        public string $externalNumber,
        public Uuid $travelServiceId,
        public ?string $internalNumber = null
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'externalNumber' => $this->externalNumber,
            'travelServiceId' => $this->travelServiceId->toRfc4122(),
            'internalNumber' => $this->internalNumber ?? '',
        ];
    }
}
