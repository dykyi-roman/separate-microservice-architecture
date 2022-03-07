<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Logger;

use Travel\Infrastructure\Http\Request;

final class LoggerRequest
{
    public function __construct(private Request $request)
    {
    }

    public function content(): string
    {
        return $this->request->content;
    }

    public function isMutation(): bool
    {
        return false !== mb_stristr($this->request->content, 'query":"mutation');
    }

    public function header(string $key): string
    {
        return $this->request->header($key);
    }
}
