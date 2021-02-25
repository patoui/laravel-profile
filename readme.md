# Profile Website/Blog

[![Build Status](https://travis-ci.org/patoui/laravel-profile.svg?branch=master)](https://travis-ci.org/patoui/laravel-profile)


Serves as a portfolio of myself, and a place where I can post articles/tips/videos about content relevant to me.

## Requirements

- PHP ^7.4
- Clickhouse
- MySQL ^5.7 | 8.x
- [Laravel 7 Requirements](https://laravel.com/docs/7.x#server-requirements)

## Installation

After cloning the repository, run these commands
```php
composer install
php artisan key:generate
php artisan migrate
```

## Testing

```
composer test
```