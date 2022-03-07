<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http\Client;

use Psr\Http\Message\RequestInterface;

interface AsyncClientInterface
{
    public function sendAsyncRequest(RequestInterface ...$requests): array;
}
