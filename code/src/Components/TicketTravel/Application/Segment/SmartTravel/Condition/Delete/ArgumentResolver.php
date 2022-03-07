<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Delete;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Type;
use Webmozart\Assert\Assert;

final class ArgumentResolver
{
    public readonly int $queryId;
    public readonly int $conditionId;
    public readonly Type $type;

    public function __construct(array $arguments)
    {
        Assert::keyExists($arguments, 'queryId');
        Assert::keyExists($arguments, 'conditionId');
        Assert::keyExists($arguments, 'type');

        $this->queryId = (int) $arguments['queryId'];
        $this->conditionId = (int) $arguments['conditionId'];

        $this->type = Type::from($arguments['type']);
    }
}
