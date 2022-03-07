<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel;

use GraphQL\Type\Definition\ObjectType;
use Travel\Components\TicketTravel\Infrastructure\Documentation\DocumentationLoader;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Mutation\CreateTravelCostMutation;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Mutation\CreateTravelMutation;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Mutation\UpdateTravelCostMutation;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Mutation\UpdateTravelMutation;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Query\ListOfLocationZonesQuery;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Query\ListOfTravelCostQuery;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Query\ListOfTravelsQuery;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Query\ReadTravelQuery;

final class Schema extends \GraphQL\Type\Schema
{
    public function __construct(
        DocumentationLoader $documentationLoader,
        ListOfLocationZonesQuery $listOfLocationZonesQuery,
        CreateTravelCostMutation $createTravelCostMutation,
        UpdateTravelCostMutation $updateTravelCostMutation,
        CreateTravelMutation $createTravelMutation,
        UpdateTravelMutation $updateTravelMutation,
        ListOfTravelsQuery $listOfTravelsQuery,
        ReadTravelQuery $readTravelQuery,
        ListOfTravelCostQuery $listOfTravelCostsQuery,
    ) {
        $doc = $documentationLoader->load();

        parent::__construct([
            'query' => new ObjectType([
                'name' => 'Query',
                'description' => $doc['tariff']['description'],
                'fields' => [
                    'readTravel' => $readTravelQuery($doc['tariff']['readTravel']),
                    'listOfTravelCosts' => $listOfTravelCostsQuery($doc['tariff']['listOfTravelCosts']),
                    'listOfTravels' => $listOfTravelsQuery($doc['tariff']['listOfTravels']),
                    'listOfLocationZones' => $listOfLocationZonesQuery($doc['tariff']['listOfLocationZones']),
                ],
            ]),
            'mutation' => new ObjectType([
                'name' => 'Mutation',
                'description' => $doc['tariff']['description'],
                'fields' => [
                    'createTravel' => $createTravelMutation($doc['tariff']['createTravel']),
                    'updateTravel' => $updateTravelMutation($doc['tariff']['updateTravel']),
                    'createTravelCost' => $createTravelCostMutation($doc['tariff']['createTravelCost']),
                    'updateTravelCost' => $updateTravelCostMutation($doc['tariff']['updateTravelCost']),
                ],
            ]),
        ]);
    }
}
