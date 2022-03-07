<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Action;

use Travel\Components\TicketTravel\Application\Logger\ActionPersistMessageCreator;
use Travel\Components\TicketTravel\Application\Logger\LoggerRequest;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Server\Middleware\LoggerMiddleware;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Server\Middleware\MessageMiddleware;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Server\Server;
use Travel\Components\TicketTravel\Infrastructure\JWT\JWTReader;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Schema;
use Travel\Infrastructure\Http\Request;
use Travel\Infrastructure\Http\Response;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\Messenger\MessageBusInterface;

final class SegmentAction
{
    public function __invoke(
        SymfonyRequest $request,
        Schema $schema,
        LoggerInterface $logger,
        MessageBusInterface $messageBus
    ): JsonResponse {
        $server = new Server($schema, ...[
            new LoggerMiddleware($logger),
            new MessageMiddleware($messageBus, static function (Request $request, Response $response): ?object {
                return (new ActionPersistMessageCreator(new JWTReader()))->create(
                    new LoggerRequest($request),
                    $response
                );
            }),
        ]);

        $response = $server->run(new Request((string) $request->getContent(), $request->headers->all()));

        return new JsonResponse($response->data, $response->status);
    }
}
