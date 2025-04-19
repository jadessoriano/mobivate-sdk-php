<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Requests\Sms\Bulk;

use Jadessoriano\Mobivate\Requests\BaseRequest;

/**
 * @method BulkMessageItem setOriginator(?string $originator = null)
 * @method BulkMessageItem setRecipient(?string $recipient = null)
 * @method BulkMessageItem setText(?string $body = null)
 * @method BulkMessageItem setRouteId(string $routeId)
 * @method BulkMessageItem setReference(string $reference)
 */
class BulkMessageItem extends BaseRequest
{
    public function __construct(
        public ?string $originator = null,
        public ?string $recipient = null,
        public ?string $text = null,
        public string $routeId = 'mglobal',
        public ?string $reference = null,
    ) {}
}
