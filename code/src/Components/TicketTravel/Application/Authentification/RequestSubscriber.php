<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Authentification;

use Travel\Components\TicketTravel\Infrastructure\JWT\JWTValidator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class RequestSubscriber implements EventSubscriberInterface
{
    private const AUTHORIZATION_TOKEN = 'x-authorization-token';

    public function __construct(private JWTValidator $validator, private string $signature)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => [
                ['onKernelRequest', 20],
            ],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!str_starts_with($event->getRequest()->getRequestUri(), '/api/')) {
            return;
        }

        try {
            $this->validateToken($event->getRequest()->headers);
        } catch (UnauthorizedException $exception) {
            $this->withExceptionResponse($event, $exception);

            return;
        }
    }

    private function validateToken(HeaderBag $headers): void
    {
        if (!$headers->has(self::AUTHORIZATION_TOKEN)) {
            throw UnauthorizedException::missingToken(self::AUTHORIZATION_TOKEN);
        }

        $token = (string) $headers->get(self::AUTHORIZATION_TOKEN, '');
        if (empty($token)) {
            throw UnauthorizedException::missingToken(self::AUTHORIZATION_TOKEN);
        }

        if (!$this->validator->isExpired($token)) {
            throw UnauthorizedException::expireToken();
        }

        if (!$this->validator->isSigned($token, $this->signature)) {
            throw UnauthorizedException::invalidToken();
        }
    }

    private function withExceptionResponse(RequestEvent $event, UnauthorizedException $exception): void
    {
        $event->setResponse(
            new JsonResponse(
                [
                    'errors' => [
                        [
                            'message' => $exception->getMessage(),
                            'code' => $exception->getCode(),
                        ],
                    ],
                ], 401
            ),
        );
    }
}
