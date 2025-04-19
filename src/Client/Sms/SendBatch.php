<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Client\Sms;

use Jadessoriano\Mobivate\Client\BaseClient;
use Jadessoriano\Mobivate\Exceptions\ConfigException;
use Jadessoriano\Mobivate\Exceptions\SendBatchException;
use Jadessoriano\Mobivate\Requests\Sms\Batch\BatchMessage;
use Jadessoriano\Mobivate\Requests\Sms\Batch\BatchMessageItem;
use Jadessoriano\Mobivate\Responses\BatchMessageResponse;

readonly class SendBatch extends BaseClient
{
    public static function uri(): string
    {
        return 'send/batch';
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Jadessoriano\Mobivate\Exceptions\ConfigException
     * @throws \Jadessoriano\Mobivate\Exceptions\SendBatchException
     */
    public function execute(BatchMessage $request): BatchMessageResponse
    {
        $this->validateMessages($request);

        $response = $this->post(['json' => $request]);

        $body = json_decode((string) $response->getBody(), true);

        return new BatchMessageResponse(...$body);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Jadessoriano\Mobivate\Exceptions\ConfigException
     * @throws \Jadessoriano\Mobivate\Exceptions\SendBatchException
     */
    private function validateMessages(BatchMessage $request): void
    {
        if (empty($request->messages)) {
            throw SendBatchException::emptyMessage();
        }

        foreach ($request->messages as $message) {
            if (! $message instanceof BatchMessageItem) {
                throw SendBatchException::invalidMessage();
            }

            if ($message->originator === null) {
                throw ConfigException::missingOriginator();
            }
        }
    }
}
