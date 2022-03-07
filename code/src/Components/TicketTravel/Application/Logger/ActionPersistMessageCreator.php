<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Logger;

use Travel\Components\TicketTravel\Features\Logger\Message\ActionPersistMessage;
use Travel\Components\TicketTravel\Infrastructure\JWT\JWTReader;
use Travel\Infrastructure\Http\HttpStatus;
use Travel\Infrastructure\Http\Response;

final class ActionPersistMessageCreator
{
    private const TOKEN = 'x-authorization-token';

    public function __construct(private JWTReader $JWTReader)
    {
    }

    public function create(LoggerRequest $request, Response $response): ?ActionPersistMessage
    {
        if (!HttpStatus::isSuccess($response->status)) {
            return null;
        }
        if (!$request->isMutation()) {
            return null;
        }

        $token = $request->header(self::TOKEN);
        if ('' === $token) {
            return null;
        }

        $payload = $this->JWTReader->read($token);
        if (0 === count($payload)) {
            return null;
        }

        return new ActionPersistMessage($request->content(), $payload);
    }
}
