# folded/session

Session manipulation utilities for your web app.

[![Packagist License](https://img.shields.io/packagist/l/folded/session)](https://github.com/folded-php/session/blob/master/LICENSE) [![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/folded/session)](https://github.com/folded-php/session/blob/master/composer.json#L14) [![Packagist Version](https://img.shields.io/packagist/v/folded/session)](https://packagist.org/packages/folded/session) [![Build Status](https://travis-ci.com/folded-php/session.svg?branch=master)](https://travis-ci.com/folded-php/session) [![Maintainability](https://api.codeclimate.com/v1/badges/0bba99cf2cfc97589dab/maintainability)](https://codeclimate.com/github/folded-php/session/maintainability) [![TODOs](https://img.shields.io/endpoint?url=https://api.tickgit.com/badge?repo=github.com/folded-php/session)](https://www.tickgit.com/browse?repo=github.com/folded-php/session)

## Summary

- [About](#about)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Examples](#examples)
- [Version support](#version-support)

## About

I created this library to be able to manipulate a session, e.g. setting and getting data, checking if a data is present, ... In a standalone way.

Folded is a constellation of packages to help you setting up a web app easily, using ready to plug in packages.

- [folded/action](https://github.com/folded-php/action): A way to organize your controllers for your web app.
- [folded/config](https://github.com/folded-php/config): Configuration utilities for your PHP web app.
- [folded/crypt](https://github.com/folded-php/crypt): Encrypt and decrypt strings for your web app.
- [folded/exception](https://github.com/folded-php/exception): Various kind of exception to throw for your web app.
- [folded/history](https://github.com/folded-php/history): Manipulate the browser history for your web app.
- [folded/http](https://github.com/folded-php/http): HTTP utilities for your web app.
- [folded/orm](https://github.com/folded-php/orm): An ORM for you web app.
- [folded/request](https://github.com/folded-php/request): Request utilities, including a request validator, for your PHP web app.
- [folded/routing](https://github.com/folded-php/routing): Routing functions for your PHP web app.
- [folded/view](https://github.com/folded-php/view): View utilities for your PHP web app.

## Features

- Set and get value by keys
- Can flash value (which means they can be getted only once)
- Can remove values by key
- Can check if a value exist by its key
- Uses the plain `$_SESSION` superglobal

## Requirements

- PHP version >= 7.4.0
- Composer installed

## Installation

- [1. Install the package](#1-install-the-package)
- [2. Add the setup code](#2-add-the-setup-code)

### 1. Install the package

In your root folder, run this command:

```bash
composer require folded/session
```

### 2. Add the setup code

In the script you want to use, call for the session start function:

```php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

// ...
```

## Examples

- [1. Set a value](#1-set-a-value)
- [2. Get a value by key](#2-get-a-value-by-key)
- [3. Check if a value exist by key](#3-check-if-a-value-exist-by-key)
- [4. Flash a value](#4-flash-a-value)
- [5. Keep a value one more time after being flashed](#5-keep-a-value-one-more-time-after-being-flashed)
- [6. Remove a value by key](#6-remove-a-value-by-key)

### 1. Set a value

In this example, we will set the value in the session.

```php
use function Folded\setSession;

setSession("token", "12345");
```

### 2. Get a value by key

In this example, we will get the value of a session key.

```php
use function Folded\setSession;
use function Folded\getSession;

setSession("token", "12345");

echo getSession("token"); // "12345"
```

### 3. Check if a value exist by key

In this example, we will check if a value exist by its key.

```php
use function Folded\hasSession;

if (hasSession("token")) {
  echo "has token in session";
} else {
  echo "has not token in session yet";
}
```

### 4. Flash a value

Flashing a value consist of telling the session to keep a value for a single usage. In this example, we will set a flash value, then get it once. Any attempt to get it a second time will fail.

```php
use function Folded\flashSession;
use function Folded\getSession;
use function Folded\hasSession;

flashSession("token", "12345");

echo getSession("token"); // "12345"

var_dump(hasSession("token")); // bool(false)
```

### 5. Keep a value one more time after being flashed

In this example, we will use the second parameter of `getSession()` to keep a flashed data one last time after being getted.

```php
use function Folded\getSession;
use function Folded\flashSession;
use function Folded\hasSession;

flashSession("token", "12345");

getSession("token", $keep = true);

var_dump(hasSession("token")); // bool(true)
```

### 6. Remove a value by key

In this example, we will set a value, then remove it, and check if it exist.

```php
use function Folded\hasSession;
use function Folded\removeSession;
use function Folded\setSession;

setSession("token", "12345");

var_dump(hasSession("token")); // booll(true)

removeSession("token");

var_dump(hasSession("token")); // bool(false)
```

## Version support

|        | 7.3 | 7.4 | 8.0 |
| ------ | --- | --- | --- |
| v0.1.0 | ❌  | ✔️  | ❓  |
| v0.1.1 | ❌  | ✔️  | ❓  |
| v0.2.0 | ❌  | ✔️  | ❓  |
| v0.2.1 | ❌  | ✔️  | ❓  |
| v0.2.2 | ❌  | ✔️  | ❓  |
