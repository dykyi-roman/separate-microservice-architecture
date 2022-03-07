<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Helper;

/**
 * @psalm-immutable
 */
final class UrlHelper
{
    public static function buildQuery(array $parameters): string
    {
        $parameters = array_filter($parameters, static fn ($param): bool => null !== $param);

        return urldecode(http_build_query($parameters));
    }

    public static function buildUrl(string $baseUrl, string $urlPath = ''): string
    {
        $template = empty($urlPath) ? '%s' : '%s/%s';

        return sprintf($template, rtrim($baseUrl, '/'), ltrim($urlPath, '/'));
    }
}
