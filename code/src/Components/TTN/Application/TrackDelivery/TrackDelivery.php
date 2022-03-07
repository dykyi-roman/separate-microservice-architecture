<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Application\TrackDelivery;

use Travel\Components\TTN\Application\ValidationAssert;
use Travel\Components\TTN\Features\TrackDelivery\ExpressNote;
use Travel\Components\TTN\Features\TrackDelivery\TrackDeliveryException;
use Travel\Components\TTN\Features\TrackDelivery\TrackDeliveryManager;
use Symfony\Component\Uid\Uuid;
use Throwable;

final class TrackDelivery
{
    public function __construct(private TrackDeliveryManager $trackDeliveryManager)
    {
    }

    /**
     * @throws \InvalidArgumentException
     * @throws TrackDeliveryException
     */
    public function track(string $externalNumber, string $travelServiceId, ?string $internalNumber = null): void
    {
        ValidationAssert::isEmpty($externalNumber, ErrorCode::EXTERNAL_NUMBER_FIELD_IS_EMPTY->value);
        ValidationAssert::uuid($travelServiceId, ErrorCode::INVALID_UUID->value);

        $this->trackDeliveryManager->track(
            new ExpressNote(
                $externalNumber,
                Uuid::fromString($travelServiceId),
                $internalNumber
            )
        );
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function trackCollection(array $collection): void
    {
        $notes = [];
        foreach ($collection as $item) {
            try {
                ValidationAssert::keyExists($item, 'externalNumber', ErrorCode::WRONG_INCOMING_PARAMETERS->value);
                ValidationAssert::keyExists($item, 'travelServiceId', ErrorCode::WRONG_INCOMING_PARAMETERS->value);
                ValidationAssert::isEmpty($item['externalNumber'], ErrorCode::EXTERNAL_NUMBER_FIELD_IS_EMPTY->value);
                ValidationAssert::uuid($item['travelServiceId'], ErrorCode::INVALID_UUID->value);

                $notes[] = new ExpressNote(
                    (string) $item['externalNumber'],
                    Uuid::fromString((string) $item['travelServiceId']),
                    array_key_exists('internalNumber', $item) ? (string) $item['internalNumber'] : null
                );
            } catch (Throwable) {
                // skip not valid express note
            }
        }

        if (0 < count($notes)) {
            $this->trackDeliveryManager->trackCollection(...$notes);
        }
    }
}
