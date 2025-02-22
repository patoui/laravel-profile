# 👋🏻 Profile


Serves as a portfolio website of myself, and a place where I can post articles/tips/videos about content relevant to me.

## 📋 Requirements

- PHP ^8.2
- SQLite

## 📥 Installation

After cloning the repository, run these commands
```php
composer install
php artisan key:generate
php artisan migrate
```

## 🧪 Testing

```
composer test
```

## 👷 Build production assets

```
npm i --legacy-peer-deps
NODE_OPTIONS="--openssl-legacy-provider" npm run production
```