# Useful Laravel collection macros

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pulli/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/pulli/laravel-collection-macros)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/the-pulli/laravel-collection-macros/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/pulli/laravel-collection-macros/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/the-pulli/laravel-collection-macros/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/pulli/laravel-collection-macros/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/pulli/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/pulli/laravel-collection-macros)

Contains some handy collection macros.

## Installation

You can install the package via composer:

```bash
composer require pulli/laravel-collection-macros
```

You can publish the service provider via:

```bash
php artisan vendor:publish --tag="pulli-collection-macros-provider"
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="pulli-collection-macros-config"
```

This is the contents of the published config file:

```php
return [
    'auto-update' => true,
];
```

## Usage

### Macros

- even
- firstAndLast
- firstAndLastKey
- implodeToStringable
- joinToStringable
- mapToCollection
- mapToCollectionFrom
- odd
- positive
- recursiveToArrayFrom
- recursiveToArray

#### `even`

Filter the collection to only integer values and return the even ones.

```php
$collection = Collection::range(0, 6)->even();

// returns [0, 2, 4, 6]

// optional you can pass true as parameter to preserve the original array keys

$collection = Collection::range(0, 6)->even(true);

// returns [0 => 0, 2 => 2, 4 => 4, 6 => 6]
```

#### `firstAndLast`

Returns the first and last element as array.
Optional a callable and a default value for the first and last element can be specified.

```php
[$first, $last] = Collection::make(['Jane', 'John', 'Joe'])->firstAndLast();

// $first = 'Jane', $last = 'Joe'
```

#### `firstAndLastKey`

Returns the first and last key as array.
Optional a callable and a default value for the first and last element can be specified.

```php
[$first, $last] = Collection::make(['Jane', 'John', 'Joe'])->firstAndLastKey();

// $first = 0, $last = 2
```

#### `implodeToStringable`

Implodes the collection to a Stringable object.

```php
$collection = Collection::make(['Jane', 'John'])->implodeToStringable(', ');

// Stringable of "Jane, John"
```

#### `joinToStringable`

Joins the collection to a Stringable object.

```php
$collection = Collection::make(['Jane', 'John', 'Jack'])->joinToStringable(', ', ' and ');

// Stringable of "Jane, John and Jack"
```

#### `mapToCollectionFrom`

Static method: Maps all arrays/objects recursively to a collection object of collections, which allow nested function calling.

```php
$collection = Collection::mapToCollectionFrom([['test' => 1], 2, 3]);

$collection->get(0)->get('test'); // returns 1

// Item has a toArray() public method, then it can be wrapped into a collection like this:
$collection = Collection::mapToCollectionFrom([Item(), Item()], true);
```

#### `odd`

Filter the collection to only integer values and return the odd ones.

```php
$collection = Collection::range(0, 6)->odd();

// returns [1, 3, 5]

// optional you can pass true as parameter to preserve the original array keys

$collection = Collection::range(0, 6)->odd(true);

// returns [1 => 1, 3 => 3, 5 => 5]
```

#### `positive`

Returns a boolean value, if the collection contains elements or not.

```php
Collection::make([1, 2, 3])->positive() // returns true
Collection::make()->positive() // returns false
```

#### `recursiveToArrayFrom`

Static method: Like `mapToCollectionFrom` it maps all arrays/objects recursively to an array.

```php
// Item has a toArray() public method, then it can be wrapped into the collection like this:
$array = Collection::recursiveToArrayFrom(['item1' => Item(), 'item2' => Item()]);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [PuLLi](https://github.com/the-pulli)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
