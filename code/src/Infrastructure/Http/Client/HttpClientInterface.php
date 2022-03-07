<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http\Client;

use Psr\Http\Client\ClientInterface;

interface HttpClientInterface extends ClientInterface, AsyncClientInterface
{
}
