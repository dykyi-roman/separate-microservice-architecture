<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\Message\Handler;

use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\FolderManager;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\Message\Command\DeleteSmartTravelCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class DeleteSmartTravelCommandHandler implements MessageHandlerInterface
{
    public function __construct(private FolderManager $smartFolder)
    {
    }

    public function __invoke(DeleteSmartTravelCommand $command): void
    {
        $this->smartFolder->delete($command->travelId);
    }
}
