<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Features\OrderStatus\Message;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class OrderStatusMessageHandler implements MessageHandlerInterface
{
    public function __invoke(OrderStatusMessage $message): void
    {
        //todo ....
    }
}
