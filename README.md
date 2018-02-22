# REST module

[![Build Status](https://travis-ci.org/frameworkwtf/rest.svg?branch=master)](https://travis-ci.org/frameworkwtf/rest) [![Coverage Status](https://coveralls.io/repos/frameworkwtf/rest/badge.svg?branch=master&service=github)](https://coveralls.io/github/frameworkwtf/rest?branch=master)

## Installation

### Install via Composer

```php
composer require wtf/rest
```

### Configure your app

Create config file `jwt.php`:

```php
<?php

declare(strict_types=1);

return [
	"path" => "/api",
	"passthrough" => ["/api/login"],
	"secret" => 'JWT_SECRET',
];
```

Documentation: [tuupola/slim-jwt-auth](https://github.com/tuupola/slim-jwt-auth/tree/3.x#usage)

### Add new provider and middleware

1. `\Wtf\Rest\Provider` into your providers list (`suit.php` config)
2. `jwt_middleware` into your middlewares list (`suit.php` config)
