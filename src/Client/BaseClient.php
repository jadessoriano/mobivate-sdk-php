<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Client;

use Jadessoriano\Mobivate\MobivateClient;
use Psr\Http\Message\ResponseInterface;

abstract readonly class BaseClient
{
    abstract public static function uri(): string;

    public function __construct(private MobivateClient $mobivateClient)
    {
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(array $options = []): ResponseInterface
    {
        return $this->mobivateClient
            ->client()
            ->post(static::uri(), $options);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $appendUrl = '', array $options = []): ResponseInterface
    {
        return $this->mobivateClient
            ->client()
            ->post(static::uri()."/$appendUrl", $options);
    }
}
