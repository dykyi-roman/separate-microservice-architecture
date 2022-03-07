<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Tests\Infrastructure\Gateway;

use GraphQL\Query;
use Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\DeliveryClient;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\QueryToJsonTransformer;
use Travel\Infrastructure\Http\Client\CallbackHttpClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * @coversDefaultClass \Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\DeliveryClient
 */
final class DeliveryApiClientTest extends TestCase
{
    /**
     * @covers ::send
     */
    public function testSendRequestWithBodyAndHeaders(): void
    {
        $callback = static function (RequestInterface $request) {
            self::assertArrayHasKey('Authorization', $request->getHeaders());
            self::assertSame('{"query":"query"}', $request->getBody()->getContents());
        };

        $body = (string) new QueryToJsonTransformer(new Query());

        (new DeliveryClient('test-url', 'user:pass', new CallbackHttpClient($callback)))->get($body);
    }
}
