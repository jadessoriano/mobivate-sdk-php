<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Exceptions;

class ConfigException extends MobivateException
{
    public static function missingOriginator(): self
    {
        return new self('No Originator/SenderID for SMS message/s was found.');
    }
}
