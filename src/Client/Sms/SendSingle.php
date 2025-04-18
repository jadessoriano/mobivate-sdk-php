<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Client\Sms;

use Jadessoriano\Mobivate\Client\BaseClient;
use Jadessoriano\Mobivate\Requests\Sms\Message;
use Jadessoriano\Mobivate\Responses\MessageResponse;

readonly class SendSingle extends BaseClient
{
    public static function uri(): string
    {
        return 'send/single';
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute(Message $request): MessageResponse
    {
        $response = $this->post(['json' => $request]);

        $body = json_decode((string) $response->getBody(), true);

        return new MessageResponse(...$body);
    }
}
