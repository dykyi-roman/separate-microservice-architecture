<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;

/**
 * @psalm-suppress InvalidReturnType
 * @psalm-suppress InvalidReturnStatement
 * @psalm-suppress InvalidPropertyAssignmentValue
 */
abstract class SingletonObjectType extends ObjectType
{
    protected static string $type;

    public static function instance(): ObjectType
    {
        if (!isset(static::$standardTypes[static::$type])) {
            $class = static::class;
            /* @phpstan-ignore-next-line */
            static::$standardTypes[static::$type] = new $class();
        }
        /* @phpstan-ignore-next-line */
        return static::$standardTypes[static::$type];
    }
}
