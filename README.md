![Mobivate SDK PHP](https://github.com/user-attachments/assets/073b640e-628f-4360-a89b-1a8f0b9c59fc)

# Mobivate Bulk SMS SDK for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jadessoriano/mobivate-sdk-php.svg?style=flat-square)](https://packagist.org/packages/jadessoriano/mobivate-sdk-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/jadessoriano/mobivate-sdk-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jadessoriano/mobivate-sdk-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jadessoriano/mobivate-sdk-php.svg?style=flat-square)](https://packagist.org/packages/jadessoriano/mobivate-sdk-php)
<!--delete-->
---
[Mobivate Bulk SMS](https://www.mobivate.com/bulk-sms) SDK for PHP:

- [Installation](#installation)
- Usage
    - [Send Single SMS Message](#single-send-sms-message)
    - [Send Batch SMS Messages](#send-batch-sms-messages)

TODO List:

- Search Message Logs
- Search for Single Message Log

Additional:

- [Mobivate Bulk SMS for Laravel](https://github.com/jadessoriano/laravel-mobivate-sdk)

---
<!--/delete-->

## Installation

You can install the package via composer:

```bash
composer require jadessoriano/mobivate-sdk-php
```

## [Single Send SMS Message](https://wiki.mobivatebulksms.com/use-cases/send-single-sms-message)

```php

use Jadessoriano\Mobivate\Client\Credentials\Basic;
use Jadessoriano\Mobivate\Client\Sms\SendSingle;
use Jadessoriano\Mobivate\MobivateClient;
use Jadessoriano\Mobivate\Requests\Sms\Message;

$client = new MobivateClient(
    new Basic('api_live_abcd1234efgh5678ijkl9012mnop3456')
);

$response = (new SendSingle($client))
    ->execute(
        new Message(
            originator: 'Test',             // Optional: defaults to config value if not provided
            recipient: '44700011122',
            body: 'This is a test message',
            reference: 'sample',            // Optional: defaults to null if not provided
            campaignId: '1-xxx'             // Optional: defaults to null if not provided
        )
    )

```

## [Send Batch SMS Messages](https://wiki.mobivatebulksms.com/use-cases/send-batch-sms-messages)

```php

use Jadessoriano\Mobivate\Client\Credentials\Basic;
use Jadessoriano\Mobivate\Client\Sms\SendBatch;
use Jadessoriano\Mobivate\MobivateClient;
use Jadessoriano\Mobivate\Requests\Sms\Batch\BatchMessage;
use Jadessoriano\Mobivate\Requests\Sms\Batch\BatchMessageItem;

$client = new MobivateClient(
    new Basic('api_live_abcd1234efgh5678ijkl9012mnop3456')
);

/**
 * Note: The schedule date time (for later delivery) is optional, defaults to null if not provided.
 */
$message = (new BatchMessage())
    ->setMessages([
        new BatchMessageItem(
            originator: 'Test', // Optional: defaults to config value if not provided
            recipient: '44700011122',
            text: 'This is a test message'
        )
    ])
    ->setScheduleDateTime(
        new DateTime('+5 minutes', new DateTimeZone('Asia/Manila'))
    )

$response = (new SendBatch($client))->execute($message)

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [jadessoriano](https://github.com/jadessoriano)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
