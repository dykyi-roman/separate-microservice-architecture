<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Features\TrackDelivery;

use Psr\Log\LoggerInterface;
use Throwable;

final class TrackDeliveryManager
{
    public function __construct(private TrackDeliveryGatewayInterface $bookingGateway, private LoggerInterface $logger)
    {
    }

    public function track(ExpressNote $expressNote, bool $async = false): void
    {
        try {
            $this->bookingGateway->track($expressNote, $async);

            return;
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );
        }

        throw TrackDeliveryException::failedToTrackDelivery($expressNote);
    }

    public function trackCollection(ExpressNote ...$expressNotes): void
    {
        try {
            $this->bookingGateway->trackCollection(...$expressNotes);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );
        }
    }
}
