<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Update;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\ConditionFactory;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\FolderException;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\FolderManager;

final class Resolver
{
    public function __construct(private FolderManager $travel, private ConditionFactory $conditionFactory)
    {
    }

    public function __invoke(ArgumentResolver $argResolver): SegmentDto
    {
        $title = $argResolver->title;
        try {
            if ($argResolver->title) {
                $this->travel->rename($argResolver->travelId, $argResolver->title);
            }
        } catch (FolderException) {
            $title = null;
        }

        $conditionIds = [];
        foreach ($argResolver->conditions as $condition) {
            $conditionManager = $this->conditionFactory->create($condition->isNew());
            $conditionIds[] = $conditionManager->execute($argResolver->queryId, $condition);
        }

        return new SegmentDto($title, $conditionIds);
    }
}
