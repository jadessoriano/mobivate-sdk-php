<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Client\Sms;

use Jadessoriano\Mobivate\Client\BaseClient;
use Jadessoriano\Mobivate\Exceptions\ConfigException;
use Jadessoriano\Mobivate\Exceptions\SendBulkException;
use Jadessoriano\Mobivate\Requests\Sms\Bulk\BulkMessage;
use Jadessoriano\Mobivate\Requests\Sms\Bulk\BulkMessageItem;
use Jadessoriano\Mobivate\Responses\BulkMessageResponse;

readonly class SendBulk extends BaseClient
{
    public static function uri(): string
    {
        return 'send/batch';
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Jadessoriano\Mobivate\Exceptions\ConfigException
     * @throws \Jadessoriano\Mobivate\Exceptions\SendBulkException
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

        foreach ($request->messages as $message) {
            if (! $message instanceof BulkMessageItem) {
                throw SendBulkException::invalidMessage();
            }

            if ($message->originator === null) {
                throw ConfigException::missingOriginator();
            }
        }
    }
}
