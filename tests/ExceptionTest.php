<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Jadessoriano\Mobivate\Client\Sms\SendBatch;
use Jadessoriano\Mobivate\Client\Sms\SendSingle;
use Jadessoriano\Mobivate\Exceptions\ConfigException;
use Jadessoriano\Mobivate\Exceptions\SendBatchException;
use Jadessoriano\Mobivate\Requests\Sms\Batch\BatchMessage;
use Jadessoriano\Mobivate\Requests\Sms\Batch\BatchMessageItem;
use Jadessoriano\Mobivate\Requests\Sms\Message;

beforeEach(function () {
    $mock = new MockHandler(
        [
            new Response(
                200,
                [],
                '',
            ),
        ]
    );

    $this->client = generateMovibateClient($mock);

    $this->message = (new Message)
        ->setRecipient('44700011122')
        ->setBody('This is a test message')
        ->setRouteId('mglobal');

    $this->batchMessageItem = (new BatchMessageItem)
        ->setRecipient('44700011122')
        ->setText('This is a test message')
        ->setRouteId('mglobal');
});

it('throws config exception (send single)', function () {
    (new SendSingle($this->client))
        ->execute($this->message);
})
    ->throws(ConfigException::class);

it('throws empty message (send batch)', function () {
    (new SendBatch($this->client))
        ->execute(
            (new BatchMessage)
                ->setMessages([])
        );
})
    ->throws(SendBatchException::class);

it('throws config exception (send batch)', function () {
    (new SendBatch($this->client))
        ->execute(
            (new BatchMessage)
                ->setMessages([
                    $this->batchMessageItem,
                ])
        );
})
    ->throws(ConfigException::class);
