<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Client\Credentials;

/**
 * @property-read string $api_key
 */
class Basic extends BaseCredentials
{
    public function __construct(string $key)
    {
        $this->credentials['api_key'] = $key;
    }
}
