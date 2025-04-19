<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Requests\Sms\Batch;

use Jadessoriano\Mobivate\Requests\BaseRequest;

/**
 * @method BatchMessageItem setOriginator(?string $originator = null)
 * @method BatchMessageItem setRecipient(?string $recipient = null)
 * @method BatchMessageItem setText(?string $body = null)
 * @method BatchMessageItem setRouteId(string $routeId)
 */
class BatchMessageItem extends BaseRequest
{
    public function __construct(
        public ?string $originator = null,
        public ?string $recipient = null,
        public ?string $text = null,
        public string $routeId = 'mglobal',
    ) {
    }
}
