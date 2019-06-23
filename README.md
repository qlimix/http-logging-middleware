# http-logging-middleware

[![Travis CI](https://api.travis-ci.org/qlimix/http-logging-middleware.svg?branch=master)](https://travis-ci.org/qlimix/http-logging-middleware)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/http-logging-middleware.svg)](https://coveralls.io/github/qlimix/http-logging-middleware)
[![Packagist](https://img.shields.io/packagist/v/qlimix/http-logging-middleware.svg)](https://packagist.org/packages/qlimix/http-logging-middleware)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/http-logging-middleware/blob/master/LICENSE)

Logging request and response with PSR-15 middleware.

## Install

Using Composer:

~~~
$ composer require qlimix/http-logging-middleware
~~~

## usage
```php
<?php

use Qlimix\HttpMiddleware\RequestLoggerMiddleware;
use Qlimix\HttpMiddleware\ResponseLoggerMiddleware;

$requestLogger = new FooBarRequestLogger();
$responseLogger = new FooBarResponseLogger();

$requestLoggerMiddleware = new RequestLoggerMiddleware($requestLogger);
$responseLoggerMiddleware = new ResponseLoggerMiddleware($responseLogger);
```

## Testing
To run all unit tests locally with PHPUnit:

~~~
$ vendor/bin/phpunit
~~~

## Quality
To ensure code quality run grumphp which will run all tools:

~~~
$ vendor/bin/grumphp run
~~~

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
