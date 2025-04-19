<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Exceptions;

class SendBulkException extends MobivateException
{
    public static function emptyMessage(): self
    {
        return new self('No message found.');
    }

    public static function invalidMessage(): self
    {
        return new self('Invalid message.');
    }
}
