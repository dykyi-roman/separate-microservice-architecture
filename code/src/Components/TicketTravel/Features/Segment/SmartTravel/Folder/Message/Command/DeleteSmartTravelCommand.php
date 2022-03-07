<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\Message\Command;

use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\Message\Handler\DeleteSmartTravelCommandHandler;

/**
 * @psalm-immutable
 *
 * @see DeleteSmartTravelCommandHandler
 */
final class DeleteSmartTravelCommand
{
    public function __construct(public readonly int $travelId)
    {
    }
}
