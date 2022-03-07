<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment;

use GraphQL\Type\Definition\ObjectType;
use Travel\Components\TicketTravel\Infrastructure\Documentation\DocumentationLoader;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Mutation\CreateSegmentMutation;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Mutation\DeleteConditionMutation;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Mutation\UpdateSegmentMutation;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Query\ListOfCategoriesQuery;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Query\ListOfSellersQuery;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Query\ReadSegmentQuery;

final class Schema extends \GraphQL\Type\Schema
{
    public function __construct(
        DocumentationLoader $documentationLoader,
        ListOfCategoriesQuery $listOfCategoriesQuery,
        ListOfSellersQuery $listOfSellersQuery,
        ReadSegmentQuery $readSegmentQuery,
        CreateSegmentMutation $createSegmentMutation,
        UpdateSegmentMutation $updateSegmentMutation,
        DeleteConditionMutation $deleteConditionMutation,
    ) {
        $doc = $documentationLoader->load();

        parent::__construct([
            'query' => new ObjectType([
                'name' => 'Query',
                'description' => $doc['segment']['description'],
                'fields' => [
                    'readSegment' => $readSegmentQuery($doc['segment']['readSegment']),
                    'listOfCategories' => $listOfCategoriesQuery($doc['segment']['listOfCategories']),
                    'listOfSellers' => $listOfSellersQuery($doc['segment']['listOfSellers']),
                ],
            ]),
            'mutation' => new ObjectType([
                'name' => 'Mutation',
                'description' => $doc['segment']['description'],
                'fields' => [
                    'createSegment' => $createSegmentMutation($doc['segment']['createSegment']),
                    'updateSegment' => $updateSegmentMutation($doc['segment']['updateSegment']),
                    'deleteCondition' => $deleteConditionMutation($doc['segment']['deleteCondition']),
                ],
            ]),
        ]);
    }
}
