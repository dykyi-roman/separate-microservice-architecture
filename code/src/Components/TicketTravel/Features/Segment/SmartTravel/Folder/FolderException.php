<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder;

use Travel\Components\TicketTravel\Features\Segment\SmartTravel\ErrorCode;
use RuntimeException;

final class FolderException extends RuntimeException
{
    public static function failedToCreateSmartTravel(string $title): self
    {
        return new self(
            sprintf('Failed to create smart travel with title "%s".', $title),
            ErrorCode::FAILED_TO_CREATE_SMART_TRAVEL->value
        );
    }

    public static function failedToReadSmartTravel(int $travelId): self
    {
        return new self(
            sprintf('Failed to read smart travel with id "%d".', $travelId),
            ErrorCode::FAILED_TO_READ_SMART_TRAVEL->value
        );
    }

    public static function failedToUpdateSmartTravel(string $title): self
    {
        return new self(
            sprintf('Failed to update smart travel with title "%s".', $title),
            ErrorCode::FAILED_TO_RENAME_SMART_TRAVEL->value
        );
    }

    public static function failedToCreateQuery(int $smartFolderId): self
    {
        return new self(
            sprintf('Failed to create query for smartFolder ID "%d".', $smartFolderId),
            ErrorCode::FAILED_TO_CREATE_QUERY->value
        );
    }

    public static function failedToDeleteSmartTravel(): self
    {
        return new self('Failed to delete smart travel.', ErrorCode::FAILED_TO_DELETE_SMART_TRAVEL->value);
    }
}
