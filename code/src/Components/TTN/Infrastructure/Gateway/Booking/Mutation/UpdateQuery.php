<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Infrastructure\Gateway\Booking\Mutation;

use GraphQL\Mutation;
use GraphQL\Query;
use GraphQL\RawObject;
use Travel\Components\TTN\Features\TrackDelivery\ExpressNote;

/**
 * @psalm-immutable
 */
final class UpdateQuery
{
    public static function track(ExpressNote $expressNote, bool $async = false): Query
    {
        $note = new RawObject(
            sprintf(
                '{externalNumber: "%s" travelServiceId: "%s" %s}',
                $expressNote->externalNumber,
                $expressNote->travelServiceId->toRfc4122(),
                null === $expressNote->internalNumber ? '' : sprintf(
                    'internalNumber: "%s"',
                    $expressNote->internalNumber
                )
            )
        );

        return (new Mutation('track'))
            ->setArguments(['expressNote' => $note, 'async' => $async])
            ->setSelectionSet(['id']);
    }

    public static function trackCollection(ExpressNote ...$expressNotes): Query
    {
        $notes = [];
        foreach ($expressNotes as $note) {
            $notes[] = new RawObject(
                sprintf(
                    '{externalNumber: "%s" travelServiceId: "%s" %s}',
                    $note->externalNumber,
                    $note->travelServiceId->toRfc4122(),
                    null === $note->internalNumber ? '' : sprintf('internalNumber: "%s"', $note->internalNumber)
                )
            );
        }

        return (new Mutation('trackCollection'))
            ->setArguments(['expressNotes' => [$notes[0]]])
            ->setSelectionSet(['id']);
    }
}
