<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Jadessoriano\Mobivate\Client\Sms\SendSingle;
use Jadessoriano\Mobivate\Exceptions\ConfigException;
use Jadessoriano\Mobivate\Requests\Sms\Message;

it('throws config exception', function () {
    $mock = new MockHandler(
        [
            new Response(
                200,
                [],
                '',
            ),
        ]
    );

    (
        new SendSingle(
            generateMovibateClient($mock)
        )
    )
        ->execute(
            (new Message())
                ->setRecipient('44700011122')
                ->setBody('This is a test message')
                ->setRouteId('mglobal')
        );
})
    ->throws(ConfigException::class);
