# Baselime SDK

This is a PHP SDK for sending events to Baselime. The SDK utilizes Guzzle for HTTP requests and provides a simple interface for sending events.

## Installation

You can install the Baselime SDK via [Composer](https://getcomposer.org/):

```bash
composer require snowrunescape/baselime-sdk
```

## Usage

```php
<?php

use Baselime\Baselime;

// Initialize Baselime SDK with your API key
$baselime = new Baselime('your-api-key');

// Send an event
$baselime->event('my-service', [
    'message' => 'This is an example log event',
    'error' => 'TypeError: Cannot read property \'something\' of undefined',
    'requestId' => '6092d6f0-3bfa-4d62-9d0b-5bc7ae6518a1',
    'namespace' => 'https://api.domain.com/resource/{id}'
]);
```

## Recommendations

To enhance the efficiency of sending events to Baselime, it is recommended to use a queue system. This approach offers several benefits:

* Load Management: Queues can help balance the load by controlling the rate at which events are sent to Baselime, preventing potential overloading.

* Asynchronous Processing: Using queues allows for non-blocking event logging, improving the performance of your application.

## License

Baselime SDK is made available under the MIT License (MIT). Please see [License File](https://github.com/SnowRunescape/baselime-sdk/blob/main/LICENSE) for more information.
