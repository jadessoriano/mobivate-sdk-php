<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Jadessoriano\Mobivate\Client\Sms\SendBulk;
use Jadessoriano\Mobivate\Client\Sms\SendSingle;
use Jadessoriano\Mobivate\Exceptions\ConfigException;
use Jadessoriano\Mobivate\Exceptions\SendBulkException;
use Jadessoriano\Mobivate\Requests\Sms\Bulk\BulkMessage;
use Jadessoriano\Mobivate\Requests\Sms\Bulk\BulkMessageItem;
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

    $this->bulkMessageItem = (new BulkMessageItem)
        ->setRecipient('44700011122')
        ->setText('This is a test message')
        ->setRouteId('mglobal');
});

it('throws config exception (send single)', function () {
    (new SendSingle($this->client))
        ->execute($this->message);
})
    ->throws(ConfigException::class);

it('throws empty message (send bulk)', function () {
    (new SendBulk($this->client))
        ->execute(
            (new BulkMessage)
                ->setMessages([])
        );
})
    ->throws(SendBulkException::class);

it('throws config exception (send bulk)', function () {
    (new SendBulk($this->client))
        ->execute(
            (new BulkMessage)
                ->setMessages([
                    $this->bulkMessageItem,
                ])
        );
})
    ->throws(ConfigException::class);
