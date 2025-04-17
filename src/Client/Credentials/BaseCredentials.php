<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Client\Credentials;

abstract class BaseCredentials implements CredentialsInterface
{
    protected array $credentials = [];

    /**
     * @noinspection MagicMethodsValidityInspection
     */
    public function __get(mixed $name): mixed
    {
        return $this->credentials[$name];
    }

    public function asArray(): array
    {
        return $this->credentials;
    }
}
