<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Create;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\CreateCondition;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\FolderException;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\FolderManager;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\Message\Command\DeleteSmartTravelCommand;
use Symfony\Component\Messenger\MessageBusInterface;

final class Resolver
{
    public function __construct(
        private FolderManager $smartFolder,
        private CreateCondition $createCondition,
        private MessageBusInterface $messageBus
    ) {
    }

    public function __invoke(ArgumentResolver $arguments): SegmentDto
    {
        try {
            $travelId = $this->smartFolder->create($arguments->title);
            $queryId = $this->smartFolder->addQuery($travelId);
        } catch (FolderException $exception) {
            if (isset($travelId)) {
                $this->messageBus->dispatch(new DeleteSmartTravelCommand($travelId));
            }

            throw $exception;
        }

        $conditionIds = [];
        foreach ($arguments->conditions as $condition) {
            $conditionIds[] = $this->createCondition->execute($queryId, $condition);
        }

        return new SegmentDto($travelId, $queryId, $conditionIds);
    }
}
