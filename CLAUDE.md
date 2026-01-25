# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

A Laravel package that provides additional macros for `Illuminate\Support\Collection`. Macros are registered automatically via a service provider when the package is installed.

## Commands

```bash
# Run all tests
composer test

# Run tests with coverage
composer test-coverage

# Run a single test file
vendor/bin/pest tests/Macros/EvenTest.php

# Run a specific test by name
vendor/bin/pest --filter="returns only the even items"

# Run static analysis
composer analyse

# Format code with Pint
composer format
```

## Architecture

### Macro Registration

- `src/CollectionMacros.php` - Registry that maps macro names to their implementing classes
- `src/CollectionMacrosServiceProvider.php` - Registers all macros with Laravel's Collection class on boot

### Adding a New Macro

1. Create a class in `src/Macros/` that implements `__invoke()` returning a `Closure`
2. Register it in `src/CollectionMacros.php`'s `all()` method
3. Add tests in `tests/Macros/`

### Macro Class Pattern

Each macro is a class with an `__invoke()` method that returns a Closure. The Closure is bound to the Collection instance, so `$this` refers to the collection:

```php
class Even
{
    public function __invoke(): Closure
    {
        return function (bool $preserveKeys = false): Collection {
            // $this is the Collection instance
            return $this->filter(fn ($v) => $v % 2 === 0);
        };
    }
}
```

### Test Structure

Tests use Pest with Orchestra Testbench. The base `TestCase` in `tests/TestCase.php` automatically loads the service provider. Shared datasets go in `tests/Datasets/`.
