<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http;

/**
 * @psalm-immutable
 */
final class Response
{
    public readonly int $status;

    public function __construct(public readonly array $data, HttpStatus $status)
    {
        $this->status = $status->value;
    }
}
