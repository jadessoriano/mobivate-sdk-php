<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Jadessoriano\Mobivate\Client\Sms\SingleMessageClient;
use Jadessoriano\Mobivate\Requests\Sms\SingleMessageRequest;
use Jadessoriano\Mobivate\Responses\MessageResponse;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNull;

it('send single message', function () {
    $responseData = '{
        "id":"ef5796ce-e326-4a09-9033-6b457039b1ba",
        "originator":"Test",
        "recipient":"44700011122",
        "body":"This is a test message",
        "routeId":"mglobal",
        "reference":null,
        "campaignId":null
    }';

    $mock = new MockHandler(
        [
            new Response(
                200,
                [],
                $responseData,
            ),
        ]
    );

    $singleMessageResponse = (
        new SingleMessageClient(
            generateMovibateClient($mock)
        )
    )
        ->execute(
            (new SingleMessageRequest())
                ->setOriginator('Test')
                ->setRecipient('44700011122')
                ->setBody('This is a test message')
                ->setRouteId('mglobal')
        );

    assertInstanceOf(MessageResponse::class, $singleMessageResponse);

    assertEquals('ef5796ce-e326-4a09-9033-6b457039b1ba', $singleMessageResponse->id);
    assertEquals('Test', $singleMessageResponse->originator);
    assertEquals('44700011122', $singleMessageResponse->recipient);
    assertEquals('This is a test message', $singleMessageResponse->body);
    assertEquals('mglobal', $singleMessageResponse->routeId);
    assertNull($singleMessageResponse->reference);
    assertNull($singleMessageResponse->campaignId);
});
