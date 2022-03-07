<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Logger\Message;

use Travel\Components\TicketTravel\Features\Logger\ActionLogCreator;
use Travel\Components\TicketTravel\Features\Logger\ActionLogRepositoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Throwable;

final class ActionPersistMessageHandler implements MessageHandlerInterface
{
    public function __construct(
        private ActionLogRepositoryInterface $actionLogRepository,
        private ActionLogCreator $actionLogCreator,
        private LoggerInterface $logger
    ) {
    }

    public function __invoke(ActionPersistMessage $message): void
    {
        try {
            $actionLog = $this->actionLogCreator->create($message);

            $this->actionLogRepository->add($actionLog);
            $this->actionLogRepository->save();
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );
        }
    }
}
