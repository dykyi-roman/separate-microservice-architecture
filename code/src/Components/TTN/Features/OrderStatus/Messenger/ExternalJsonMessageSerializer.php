<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Features\OrderStatus\Messenger;

use Travel\Components\TTN\Features\OrderStatus\Message\OrderStatusMessage;
use RuntimeException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

final class ExternalJsonMessageSerializer implements SerializerInterface
{
    /**
     * @see https://symfonycasts.com/screencast/messenger/transport-serializer
     */
    public function decode(array $encodedEnvelope): Envelope
    {
        $body = $encodedEnvelope['body'];
        $headers = $encodedEnvelope['headers'];

        $data = unserialize($body);

        if (null === $data) {
            throw new MessageDecodingFailedException('Invalid JSON');
        }

        if (!array_key_exists('orderId', (array) $data) && !array_key_exists('status', (array) $data)) {
            throw new MessageDecodingFailedException('Invalid data');
        }

        $stamps = [];
        if (isset($headers['stamps'])) {
            $stamps = unserialize($headers['stamps']);
        }

        /* @phpstan-ignore-next-line */
        $envelope = new Envelope(new OrderStatusMessage((int) $data['orderId'], (int) ['status']));

        /* @phpstan-ignore-next-line */
        return $envelope->with(...$stamps);
    }

    public function encode(Envelope $envelope): array
    {
        throw new RuntimeException('Transport & serializer not meant for sending messages.');
    }
}
