<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http;

use function mb_strtolower;

final class Request
{
    public function __construct(public readonly string $content, public readonly array $headers)
    {
    }

    public function header(string $key): string
    {
        if (!array_key_exists(mb_strtolower($key), $this->headers)) {
            return '';
        }

        return $this->headers[mb_strtolower($key)][0];
    }
}
