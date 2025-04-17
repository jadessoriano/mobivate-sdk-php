<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Responses;

class MessageResponse extends BaseResponse
{
    public function __construct(
        public string $id,
        public string $originator,
        public string $recipient,
        public string $body,
        public string $routeId,
        public ?string $reference = null,
        public ?string $campaignId = null,
        public bool $shortenUrls = false,
    ) {}
}
