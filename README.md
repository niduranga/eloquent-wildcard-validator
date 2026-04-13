# Eloquent Wildcard Validator

[![Tests](https://github.com/laraorvite/eloquent-wildcard-validator/actions/workflows/run-tests.yml/badge.svg)](https://github.com/laraorvite/eloquent-wildcard-validator/actions)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

This package fixes the `ErrorException: Indirect modification of overloaded property` that occurs in Laravel when performing wildcard validation on nested data structures containing Eloquent models or objects with magic methods.

## The Problem

In Laravel core, when you validate nested data using wildcards (e.g., `tickets.*.people.*.email`), the validator attempts to initialize missing data. If the data contains Eloquent models, PHP throws an error because magic methods (`__get` and `__set`) do not support indirect modification by reference.

## The Solution

This package transparently extends the Laravel Validator to ensure that all data is safely converted to a plain array (arrayified) before validation begins, preventing any illegal modification of model properties while preserving the original data integrity.

## Installation

You can install the package via composer:

```bash
composer require laraorvite/eloquent-wildcard-validator
````

The package will automatically register its Service Provider.

## Usage

No additional configuration is required. Use the Laravel `Validator` facade or `$request->validate()` as you normally would:

```php
$data = [
    'orders' => Order::with('items')->get()
];

$request->validate([
    'orders.*.items.*.price' => 'required|numeric'
]);
```

## Credits

- [LaraOrVite](https://github.com/LaraOrVite)
- Special thanks to the Laravel community.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.