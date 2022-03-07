<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Documentation;

use Psr\Log\LoggerInterface;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Exception\RuntimeException;
use Symfony\Component\Yaml\Yaml;

final class DocumentationLoader
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    /**
     * @throws RuntimeException
     * @throws ParseException
     */
    public function load(): array
    {
        $filePath = __DIR__ . '/../../config/documentation.yaml';
        try {
            $file = file_get_contents($filePath);
            if (false === $file) {
                throw new RuntimeException(sprintf('Could not read file "%s"', $filePath));
            }

            return (array) Yaml::parse($file);
        } catch (ParseException $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => 'Unable to parse the YAML string: %s', $exception->getMessage()])
            );

            throw $exception;
        }
    }
}
