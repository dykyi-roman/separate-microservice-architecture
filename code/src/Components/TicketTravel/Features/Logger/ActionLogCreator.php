<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Logger;

use DateTimeImmutable;
use Travel\Components\TicketTravel\Features\Logger\Entity\ActionLog;
use Travel\Components\TicketTravel\Features\Logger\Message\ActionPersistMessage;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Parser\Schema;

final class ActionLogCreator
{
    public function create(ActionPersistMessage $message): ActionLog
    {
        $schema = new Schema($message->request);

        return new ActionLog(
            $message->payload['project-name'] ?? 'undefined',
            $schema->method,
            [
                'user-id' => $message->payload['id'] ?? '',
                'user-login' => $message->payload['login'] ?? '',
            ],
            $schema->variables,
            new DateTimeImmutable()
        );
    }
}
