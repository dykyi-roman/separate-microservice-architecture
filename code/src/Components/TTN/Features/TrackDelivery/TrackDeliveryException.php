<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Features\TrackDelivery;

use RuntimeException;

final class TrackDeliveryException extends RuntimeException
{
    public static function failedToTrackDelivery(ExpressNote $expressNote): self
    {
        return new self(
            sprintf('Failed to track travel by express note: "%s".', implode(',', $expressNote->jsonSerialize())),
            ErrorCode::FAILED_TO_TRACK_TRAVEL->value
        );
    }
}
