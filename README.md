![Mobivate SDK PHP](https://github.com/user-attachments/assets/073b640e-628f-4360-a89b-1a8f0b9c59fc)

# Mobivate SDK for PHP (WIP)



[![Latest Version on Packagist](https://img.shields.io/packagist/v/jadessoriano/mobivate-sdk-php.svg?style=flat-square)](https://packagist.org/packages/jadessoriano/mobivate-sdk-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/jadessoriano/mobivate-sdk-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jadessoriano/mobivate-sdk-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jadessoriano/mobivate-sdk-php.svg?style=flat-square)](https://packagist.org/packages/jadessoriano/mobivate-sdk-php)
<!--delete-->
---
Mobivate SDK for PHP.

- [Installation](#installation)
- Usage
    - [Send Single Message](#single-send-message)
    - [Send Bulk Message](#bulk) (TODO)

---
<!--/delete-->
⚠️ **This project is a work in progress.**
May contain breaking changes or incomplete features. Use at your own risk. Contributions are welcome!

## Installation

You can install the package via composer:

```bash
composer require jadessoriano/mobivate-sdk-php
```

## [Single Send Message](https://wiki.mobivatebulksms.com/use-cases/send-single-sms-message)

```php

use Jadessoriano\Mobivate\Client\Credentials\Basic;
use Jadessoriano\Mobivate\Client\Sms\SingleMessageClient;
use Jadessoriano\Mobivate\Requests\Sms\SingleMessageRequest;

$credentials = new Basic('api_live_abcd1234efgh5678ijkl9012mnop3456');

$response = (new SingleMessageClient($singleMessage))
    ->execute(
        (new SingleMessageRequest())
            ->setOriginator('Test')
            ->setRecipient('44700011122')
            ->setBody('This is a test message')
            ->setRouteId('mglobal')
    )

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

- [:author_name](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
