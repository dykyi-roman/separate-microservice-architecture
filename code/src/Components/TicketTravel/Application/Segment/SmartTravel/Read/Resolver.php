<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Read;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Condition;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Type;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum\FieldGoods;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\FolderManager;

final class Resolver
{
    public function __construct(private FolderManager $travel)
    {
    }

    public function __invoke(ArgumentResolver $argResolver): SegmentDto
    {
        $travelDto = $this->travel->read($argResolver->travelId);

        return new SegmentDto(
            $travelDto->queryId,
            $travelDto->title,
            ...[
                ...$this->filterConditions($travelDto->filterConditions),
                ...$this->numberConditions($travelDto->numberConditions),
        ]);
    }

    private function numberConditions(array $numberConditions): array
    {
        $conditions = [];
        foreach ($numberConditions as $condition) {
            if (FieldGoods::GOODS_SELLER_ID->value === $condition['field']) {
                $conditions[] = new Condition((int) $condition['id'], (string) $condition['values'][0], Type::SELLER);
            }

            if (FieldGoods::GOODS_SLA_ID->value === $condition['field']) {
                $conditions[] = new Condition((int) $condition['id'], (string) $condition['values'][0], Type::ORDER);
            }
        }

        return $conditions;
    }

    private function filterConditions(array $filterConditions): array
    {
        $conditions = [];
        foreach ($filterConditions as $condition) {
            $conditions[] = new Condition(
                (int) $condition['filterEntities'][0]['id'],
                (string) $condition['filterEntities'][0]['valueData'][0]['value'],
                Type::CATEGORY
            );
        }

        return $conditions;
    }
}
