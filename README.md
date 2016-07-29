# Profiler
ZF2 Module. Allow profiling and log slow request

## Contents
- [Introduction](#introduction)
- [Installation](#installation)
- [Configuring](#configuring)

Introduction
------------
Module for allow profiling page load speed. You can add custom timers for detail analyze page loading workflow.

Installation
------------
### Main Setup

#### By cloning project

Clone this project into your `./vendor/` directory.

#### With composer

Add this project in your composer.json:

```json
"require": {
    "t4web/profiler": "~0.1.0"
}
```

Now tell composer to download `T4web\Profiler` by running the command:

```bash
$ php composer.phar update
```

#### Post installation

Enabling it in your `application.config.php`file.

```php
<?php
return array(
    'modules' => array(
        // ...
        'T4web\DefaultService',
        'T4web\Profiler',
    ),
    // ...
);
```

`T4web\Profiler` require `T4web\DefaultService` module.

Configuring
------------
By default profiles not store (using `NullAdapter`), for storing page profiles into your DB, you can use `DbAdapter`.
Run init script for create `profiler` table:

```shell
$ php public/index.php profiler init
```

Change default `StorageAdapter`:

```php
'service_manager' => [
    'factories' => [
        \T4web\Profiler\StorageAdapter\StorageAdapterInterface::class => \T4web\Profiler\StorageAdapter\DbAdapterFactory::class,
    ],
],
```

Or, you can implement `T4web\Profiler\StorageAdapter\StorageAdapterInterface` for create own profiler storage.

By default profiler calculate basic ZF2 event execution:

```json
{
    "route": "1ms",
    "dispatch": "12ms",
    "render": "0ms",
    "finish": "0ms"
}
```

you can disable this like this:

```php
't4web-profiler' => [
    'use-default-listeners' => false,
],
```
