<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Jadessoriano\Mobivate\Client\Sms\SendBatch;
use Jadessoriano\Mobivate\Responses\BatchMessageResponse;
use Jadessoriano\Mobivate\Tests\TestHelper;

use function PHPUnit\Framework\assertInstanceOf;

it('send batch message', function () {
    $responseData = TestHelper::jsonBatchSendMessage();

    $mock = new MockHandler(
        [
            new Response(
                200,
                [],
                $responseData,
            ),
        ]
    );

    $batchMessageResponse = (new SendBatch(generateMovibateClient($mock)))
        ->execute(TestHelper::buildBatchMessage());

    assertInstanceOf(BatchMessageResponse::class, $batchMessageResponse);
});
