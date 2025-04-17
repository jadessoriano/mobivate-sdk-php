<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Requests\Sms;

use Jadessoriano\Mobivate\Requests\BaseRequest;

/**
 * @method SingleMessageRequest setOriginator(?string $originator = null)
 * @method SingleMessageRequest setRecipient(?string $recipient = null)
 * @method SingleMessageRequest setBody(?string $body = null)
 * @method SingleMessageRequest setRouteId(string $routeId)
 * @method SingleMessageRequest setReference(string $reference)
 * @method SingleMessageRequest setCampaignId(string $campaignId)
 */
class SingleMessageRequest extends BaseRequest
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
