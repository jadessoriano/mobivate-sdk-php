<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Jadessoriano\Mobivate\Client\Sms\SendBulk;
use Jadessoriano\Mobivate\Responses\BulkMessageResponse;
use Jadessoriano\Mobivate\Tests\TestHelper;

use function PHPUnit\Framework\assertInstanceOf;

it('send bulk message', function () {
    $responseData = TestHelper::jsonBulkSendMessage();

    $mock = new MockHandler(
        [
            new Response(
                200,
                [],
                $responseData,
            ),
        ]
    );

    $bulkMessageResponse = (new SendBulk(generateMovibateClient($mock)))
        ->execute(TestHelper::buildBulkMessage());

    assertInstanceOf(BulkMessageResponse::class, $bulkMessageResponse);
});
