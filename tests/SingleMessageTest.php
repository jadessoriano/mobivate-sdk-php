<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Jadessoriano\Mobivate\Client\Sms\SendSingle;
use Jadessoriano\Mobivate\Responses\MessageResponse;
use Jadessoriano\Mobivate\Tests\TestHelper;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNull;

it('send single message', function () {
    $responseData = TestHelper::jsonSingleSendMessage();

    $mock = new MockHandler(
        [
            new Response(
                200,
                [],
                $responseData,
            ),
        ]
    );

    $singleMessageResponse = (new SendSingle(generateMovibateClient($mock)))
        ->execute(TestHelper::buildMessage());

    assertInstanceOf(MessageResponse::class, $singleMessageResponse);

    assertEquals('ef5796ce-e326-4a09-9033-6b457039b1ba', $singleMessageResponse->id);
    assertEquals('Test', $singleMessageResponse->originator);
    assertEquals('44700011122', $singleMessageResponse->recipient);
    assertEquals('This is a test message', $singleMessageResponse->body);
    assertEquals('mglobal', $singleMessageResponse->routeId);
    assertNull($singleMessageResponse->reference);
    assertNull($singleMessageResponse->campaignId);
});
