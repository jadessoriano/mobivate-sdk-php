<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Test;

use Jadessoriano\Mobivate\Requests\Sms\Batch\BatchMessage;
use Jadessoriano\Mobivate\Requests\Sms\Batch\BatchMessageItem;
use Jadessoriano\Mobivate\Requests\Sms\Message;

class TestHelper
{
    public static function jsonSingleSendMessage(): string
    {
        return '{
            "id":"ef5796ce-e326-4a09-9033-6b457039b1ba",
            "originator":"Test",
            "recipient":"44700011122",
            "body":"This is a test message",
            "routeId":"mglobal",
            "reference":null,
            "campaignId":null
        }';
    }

    public static function jsonBatchSendMessage(): string
    {
        return '{
           "id":"fd9157b74bd3475d8716a69683066f0f",
           "name":null,
           "routeId":"mglobal",
           "shortenUrls":false,
           "spreadHours":0,
           "excludeOptouts":true,
           "excludeDuplicates":false,
           "scheduleDateTime":null,
           "recipients":[
              {
                 "originator":"Test",
                 "recipient":"44700011122",
                 "text":"This is a test message",
                 "reference":null,
                 "routeId":null
              }
           ]
        }';
    }

    public static function buildBatchMessage(): BatchMessage
    {
        return (new BatchMessage())
            ->setMessages([
                self::buildBatchMessageItem(),
            ]);
    }

    public static function buildBatchMessageItem(): BatchMessageItem
    {
        return (new BatchMessageItem())
            ->setOriginator('Test')
            ->setRecipient('44700011122')
            ->setText('This is a test message')
            ->setRouteId('mglobal');
    }

    public static function buildMessage(): Message
    {
        return (new Message())
            ->setOriginator('Test')
            ->setRecipient('44700011122')
            ->setBody('This is a test message')
            ->setRouteId('mglobal');
    }
}
