<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Authorization;

use Travel\Components\TicketTravel\Infrastructure\GraphQL\Parser\Schema;
use Travel\Components\TicketTravel\Infrastructure\JWT\JWTReader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Yaml\Yaml;

final class RequestSubscriber implements EventSubscriberInterface
{
    private const AUTHORIZATION_TOKEN = 'x-authorization-token';

    public function __construct(private JWTReader $JWTReader)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => [
                ['onKernelRequest', 10],
            ],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!str_starts_with($event->getRequest()->getRequestUri(), '/api/')) {
            return;
        }

        $request = $event->getRequest();
        if (!$this->isAllowed($request->headers, (string) $request->getContent())) {
            $this->withExceptionResponse($event);
        }
    }

    private function isAllowed(HeaderBag $headers, string $content): bool
    {
        $method = (new Schema($content))->method;
        $supportPermissions = (array) Yaml::parseFile(__DIR__ . '/../../config/permission.yaml');
        $payload = $this->JWTReader->read((string) $headers->get(self::AUTHORIZATION_TOKEN, ''));

        foreach ($payload['user-permissions'] as $permission) {
            if (array_key_exists('permissions', $supportPermissions) &&
                array_key_exists((string) $permission, $supportPermissions['permissions']) &&
                in_array($method, $supportPermissions['permissions'][(string) $permission], false)
            ) {
                return true;
            }
        }

        return false;
    }

    private function withExceptionResponse(RequestEvent $event): void
    {
        $event->setResponse(
            new JsonResponse(
                [
                    'errors' => [
                        [
                            'message' => 'Access Denied',
                            'code' => ErrorCode::ACCESS_DENIED->value,
                        ],
                    ],
                ], 403
            ),
        );
    }
}
