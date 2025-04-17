<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Jadessoriano\Mobivate\Client\Credentials\Basic;
use Jadessoriano\Mobivate\MobivateClient;

function generateMovibateClient(
    MockHandler $mockHandler,
    array &$historyContainer = []
): MobivateClient {
    return (
        new MobivateClient(
            new Basic('testing')
        )
    )
        ->setHandlerStack(
            HandlerStack::create($mockHandler),
            $historyContainer
        );
}
