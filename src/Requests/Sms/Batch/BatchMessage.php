<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Requests\Sms\Batch;

use DateTimeInterface;
use Jadessoriano\Mobivate\Requests\BaseRequest;

/**
 * @method BatchMessage setMessages(array $messages = [])
 * @method BatchMessage setScheduleDateTime(string|DateTimeInterface|null $scheduleDateTime = null)
 * @method BatchMessage setShortenUrls(bool $shortenUrls = false)
 * @method BatchMessage setRouteId(string $routeId = 'mglobal')
 */
class BatchMessage extends BaseRequest
{
    public function __construct(
        public array $messages = [],
        public string|DateTimeInterface|null $scheduleDateTime = null,
        public bool $shortenUrls = false,
        public string $routeId = 'mglobal',
    ) {
    }

    public function toArray(): array
    {
        if ($this->scheduleDateTime instanceof DateTimeInterface) {
            $this->scheduleDateTime = $this->scheduleDateTime->format(DATE_ATOM);
        }

        return parent::toArray();
    }
}
