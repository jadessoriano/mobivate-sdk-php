<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Requests\Sms;

use Jadessoriano\Mobivate\Requests\BaseRequest;

/**
 * @method Message setOriginator(?string $originator = null)
 * @method Message setRecipient(?string $recipient = null)
 * @method Message setBody(?string $body = null)
 * @method Message setRouteId(string $routeId)
 * @method Message setReference(string $reference)
 * @method Message setCampaignId(string $campaignId)
 */
class Message extends BaseRequest
{
    public function __construct(
        public ?string $originator = null,
        public ?string $recipient = null,
        public ?string $body = null,
        public string $routeId = 'mglobal',
        public ?string $reference = null,
        public ?string $campaignId = null,
    ) {}

    public static function fromArray(array $data): static
    {
        $clone = $data;

        /** @phpstan-ignore-next-line  */
        $singleMessage = new static(...$data);

        if (isset($clone['originator'])) {
            $singleMessage->setOriginator($clone['originator']);
        }

        if (isset($clone['recipient'])) {
            $singleMessage->setRecipient($clone['recipient']);
        }

        if (isset($clone['body'])) {
            $singleMessage->setBody($clone['body']);
        }

        if (isset($clone['routeId'])) {
            $singleMessage->setRouteId($clone['routeId']);
        }

        if (isset($clone['reference'])) {
            $singleMessage->setReference($clone['reference']);
        }

        if (isset($clone['campaignId'])) {
            $singleMessage->setCampaignId($clone['campaignId']);
        }

        return $singleMessage;
    }
}
