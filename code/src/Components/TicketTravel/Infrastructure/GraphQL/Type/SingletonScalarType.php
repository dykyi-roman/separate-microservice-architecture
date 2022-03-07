<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Type;

use GraphQL\Type\Definition\ScalarType;

/**
 * @psalm-suppress InvalidReturnType
 * @psalm-suppress InvalidReturnStatement
 * @psalm-suppress InvalidPropertyAssignmentValue
 */
abstract class SingletonScalarType extends ScalarType
{
    protected static string $type;

    public static function instance(): ScalarType
    {
        if (!isset(static::$standardTypes[static::$type])) {
            $class = static::class;
            static::$standardTypes[static::$type] = new $class();
        }

        return static::$standardTypes[static::$type];
    }
}
