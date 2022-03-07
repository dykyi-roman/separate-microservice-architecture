<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http\ResponseExtractor;

use JsonException;
use Psr\Http\Message\ResponseInterface;

interface ResponseDataExtractorInterface
{
    /**
     * @throws JsonException
     */
    public function extract(ResponseInterface $response): array;
}
