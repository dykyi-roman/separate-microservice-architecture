<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Features\TrackDelivery;

interface TrackDeliveryGatewayInterface
{
    /**
     * @throws \RuntimeException
     */
    public function track(ExpressNote $expressNote, bool $async = false): void;

    /**
     * @throws \RuntimeException
     */
    public function trackCollection(ExpressNote ...$expressNotes): void;
}
