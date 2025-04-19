<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Responses;

class BatchMessageResponse extends BaseResponse
{
    public function __construct(
        public string $id,
        public ?string $name,
        public string $routeId,
        public bool $shortenUrls,
        public int $spreadHours,
        public bool $excludeOptouts,
        public bool $excludeDuplicates,
        public ?string $scheduleDateTime,
        public array $recipients,
    ) {
    }
}
