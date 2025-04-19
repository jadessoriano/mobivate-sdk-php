<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Requests\Sms\Batch;

use Jadessoriano\Mobivate\Requests\BaseRequest;

/**
 * @method BatchMessage setMessages(array $messages = [])
 * @method BatchMessage setScheduleDateTime(?string $scheduleDateTime = null)
 * @method BatchMessage setShortenUrls(bool $shortenUrls = false)
 * @method BatchMessage setRouteId(string $routeId = 'mglobal')
 */
class BatchMessage extends BaseRequest
{
    public function __construct(
        public array $messages = [],
        public ?string $scheduleDateTime = null,
        public bool $shortenUrls = false,
        public string $routeId = 'mglobal',
    ) {}
}
