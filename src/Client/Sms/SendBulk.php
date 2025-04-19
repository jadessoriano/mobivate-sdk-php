<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Client\Sms;

use Jadessoriano\Mobivate\Client\BaseClient;
use Jadessoriano\Mobivate\Exceptions\ConfigException;
use Jadessoriano\Mobivate\Exceptions\SendBulkException;
use Jadessoriano\Mobivate\Requests\Sms\BulkMessage;
use Jadessoriano\Mobivate\Requests\Sms\Message;
use Jadessoriano\Mobivate\Responses\BulkMessageResponse;
use Jadessoriano\Mobivate\Responses\MessageResponse;

readonly class SendBulk extends BaseClient
{
    public static function uri(): string
    {
        return 'send/batch';
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Jadessoriano\Mobivate\Exceptions\ConfigException
     * * @throws \Jadessoriano\Mobivate\Exceptions\SendBulkException
    */
    public function execute(BulkMessage $request): BulkMessageResponse
    {
        $this->validateMessages($request);

        $response = $this->post(['json' => $request]);

        $body = json_decode((string) $response->getBody(), true);

        return new BulkMessageResponse(...$body);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Jadessoriano\Mobivate\Exceptions\ConfigException
     * @throws \Jadessoriano\Mobivate\Exceptions\SendBulkException
     */
    private function validateMessages(BulkMessage $request): void
    {
        if (empty($request->messages)) {
            throw SendBulkException::emptyMessage();
        }

        /**
         * @var \Jadessoriano\Mobivate\Requests\Sms\Message $message
         */
        foreach ($request->messages as $message) {
            if (! $message instanceof Message) {
                throw SendBulkException::invalidMessage();
            }

            if ($message->originator === null) {
                throw ConfigException::missingOriginator();
            }
        }
    }
}
