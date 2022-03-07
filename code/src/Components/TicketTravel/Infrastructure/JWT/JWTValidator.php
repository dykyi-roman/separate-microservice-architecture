<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\JWT;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Throwable;

final class JWTValidator
{
    public function isSigned(string $jwt, string $signature, bool $encoded = false): bool
    {
        $config = Configuration::forUnsecuredSigner();
        $parser = new Parser(new JoseEncoder());
        try {
            $key = $encoded ? Key\InMemory::base64Encoded($signature) : Key\InMemory::plainText($signature);

            return $config->validator()->validate($parser->parse($jwt), new SignedWith(new Sha256(), $key));
        } catch (Throwable) {
            return false;
        }
    }

    public function isExpired(string $jwt): bool
    {
        try {
            return Configuration::forUnsecuredSigner()->validator()->validate(
                (new Parser(new JoseEncoder()))->parse($jwt),
                new LooseValidAt(new FrozenClock(new DateTimeImmutable()))
            );
        } catch (Throwable) {
            return false;
        }
    }
}
