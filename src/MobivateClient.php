<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Jadessoriano\Mobivate\Client\Credentials\CredentialsInterface;

/**
 * @property string $apiUrl
 */
class MobivateClient
{
    public const BASE_API = 'https://api.mobivatebulksms.com';

    public string $apiUrl;

    private ?HandlerStack $handler_stack = null;

    public function __construct(
        protected CredentialsInterface $credentials,
    ) {
        $this->apiUrl = self::BASE_API;
    }

    public function getCredentials(): CredentialsInterface
    {
        return $this->credentials;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function client(array $header = []): HttpClient
    {
        $config = [
            'base_uri' => $this->getApiUrl(),
            'headers' => $header + [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                /** @phpstan-ignore-next-line */
                'Authorization' => trim('Bearer '.$this->getCredentials()->api_key),
            ],
        ];

        if ($this->handler_stack !== null) {
            $config['handler'] = $this->handler_stack;
        }

        return new HttpClient($config);
    }

    public function setHandlerStack(HandlerStack $handlerStack, array &$historyContainer = []): static
    {
        /** @phpstan-ignore parameterByRef.type */
        $handlerStack->push(Middleware::history($historyContainer));

        $this->handler_stack = $handlerStack;

        return $this;
    }
}
