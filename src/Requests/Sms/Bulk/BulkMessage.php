<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Requests\Sms\Bulk;

use Jadessoriano\Mobivate\Requests\BaseRequest;

/**
 * @method BulkMessage setMessages(array $messages = [])
 * @method BulkMessage setScheduleDateTime(?string $scheduleDateTime = null)
 * @method BulkMessage setShortenUrls(bool $shortenUrls = false)
 * @method BulkMessage setRouteId(string $routeId = 'mglobal')
 */
class BulkMessage extends BaseRequest
{
    public function __construct(
        public array $messages = [],
        public ?string $scheduleDateTime = null,
        public bool $shortenUrls = false,
        public string $routeId = 'mglobal',
    ) {}
}
