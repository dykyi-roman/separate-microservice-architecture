<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http;

enum HttpMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
    public function isGet(): bool
    {
        return self::GET === $this;
    }

    public function isPost(): bool
    {
        return self::POST === $this;
    }
}
