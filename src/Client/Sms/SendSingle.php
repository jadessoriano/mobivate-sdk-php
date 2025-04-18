<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Client\Sms;

use Jadessoriano\Mobivate\Client\BaseClient;
use Jadessoriano\Mobivate\Exceptions\ConfigException;
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
     * @throws \Jadessoriano\Mobivate\Exceptions\ConfigException
     */
    public function execute(Message $request): MessageResponse
    {
        if ($request->originator === null) {
            throw ConfigException::missingOriginator();
        }

        $response = $this->post(['json' => $request]);

        $body = json_decode((string) $response->getBody(), true);

        return new MessageResponse(...$body);
    }
}
