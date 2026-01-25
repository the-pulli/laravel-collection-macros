# Useful Laravel collection macros

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pulli/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/pulli/laravel-collection-macros)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/the-pulli/laravel-collection-macros/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/the-pulli/laravel-collection-macros/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/the-pulli/laravel-collection-macros/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/the-pulli/laravel-collection-macros/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/the-pulli/laravel-collection-macros/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/the-pulli/laravel-collection-macros/actions?query=workflow%3Aphpstan+branch%3Amain)
[![codecov](https://codecov.io/gh/the-pulli/laravel-collection-macros/graph/badge.svg)](https://codecov.io/gh/the-pulli/laravel-collection-macros)
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

- [`compareCount`](#comparecount)
- [`even`](#even)
- [`explode`](#explode)
- [`firstAndLast`](#firstandlast)
- [`firstAndLastKey`](#firstandlastkey)
- [`implodeToStringable`](#implodetostringable)
- [`joinToStringable`](#jointostringable)
- [`mapToCollection`](#maptocollection)
- [`mapToCollectionFrom`](#maptocollectionfrom)
- [`odd`](#odd)
- [`onlyInts`](#onlyints)
- [`onlyStrings`](#onlystrings)
- [`positive`](#positive)
- [`recursiveToArray`](#recursivetoarray)
- [`recursiveToArrayFrom`](#recursivetoarrayfrom)

#### `compareCount`

Compares the count of the collection with another countable and optionally zips them together. Throws an `InvalidArgumentException` if counts don't match.

```php
compareCount(mixed $countable, bool $shouldZip = true): Collection
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$countable` | mixed | required | An array, Countable, or object with count() method |
| `$shouldZip` | bool | `true` | When true, returns zipped collection; when false, returns original |

```php
$collection = Collection::make(['a', 'b'])->compareCount([1, 2]);
// returns [['a', 1], ['b', 2]]

$collection = Collection::make(['a', 'b'])->compareCount([1, 2], shouldZip: false);
// returns ['a', 'b']

Collection::make(['a', 'b'])->compareCount([1, 2, 3]);
// throws InvalidArgumentException: Count of input mismatch with given collection.
```

#### `even`

Filters the collection to only integer values and returns the even ones.

```php
even(bool $preserveKeys = false): Collection
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$preserveKeys` | bool | `false` | Whether to preserve original array keys |

```php
$collection = Collection::range(0, 6)->even();
// returns [0, 2, 4, 6]

$collection = Collection::range(0, 6)->even(preserveKeys: true);
// returns [0 => 0, 2 => 2, 4 => 4, 6 => 6]
```

#### `explode`

Creates a collection from an exploded string. Uses the same signature as PHP's native `explode()` function.

```php
Collection::explode(string $separator, string $string, int $limit = PHP_INT_MAX): Collection
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$separator` | string | required | The delimiter string |
| `$string` | string | required | The input string to split |
| `$limit` | int | `PHP_INT_MAX` | Maximum number of elements |

```php
$collection = Collection::explode(';', 'Twenty;Banana;Boats');
// returns ['Twenty', 'Banana', 'Boats']

$collection = Collection::explode(';', 'Twenty;Banana;Boats', 2);
// returns ['Twenty', 'Banana;Boats']

$collection = Collection::explode(';', 'Twenty;Banana;Boats', -1);
// returns ['Twenty', 'Banana']
```

#### `firstAndLast`

Returns the first and last element of the collection as an array.

```php
firstAndLast(
    ?callable $first = null,
    mixed $firstDefault = null,
    ?callable $last = null,
    mixed $lastDefault = null
): array
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$first` | callable\|null | `null` | Optional callback to find the first element |
| `$firstDefault` | mixed | `null` | Default value if first element not found |
| `$last` | callable\|null | `null` | Optional callback to find the last element |
| `$lastDefault` | mixed | `null` | Default value if last element not found |

```php
[$first, $last] = Collection::make(['Jane', 'John', 'Joe'])->firstAndLast();
// $first = 'Jane', $last = 'Joe'

[$first, $last] = Collection::range(0, 6)->firstAndLast(
    first: fn ($value) => $value > 0,
    last: fn ($value) => $value < 6,
);
// $first = 1, $last = 5
```

#### `firstAndLastKey`

Returns the first and last key of the collection as an array.

```php
firstAndLastKey(
    ?callable $first = null,
    mixed $firstDefault = null,
    ?callable $last = null,
    mixed $lastDefault = null
): array
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$first` | callable\|null | `null` | Optional callback to find the first key |
| `$firstDefault` | mixed | `null` | Default value if first key not found |
| `$last` | callable\|null | `null` | Optional callback to find the last key |
| `$lastDefault` | mixed | `null` | Default value if last key not found |

```php
[$first, $last] = Collection::make(['Jane', 'John', 'Joe'])->firstAndLastKey();
// $first = 0, $last = 2

[$first, $last] = Collection::range(0, 6)->firstAndLastKey(
    first: fn ($value) => $value > 0,
    last: fn ($value) => $value < 6,
);
// $first = 1, $last = 5
```

#### `implodeToStringable`

Implodes the collection and returns it as a Stringable object.

```php
implodeToStringable(callable|string|null $value, ?string $glue = null): Stringable
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$value` | callable\|string\|null | required | The key to implode or a callback |
| `$glue` | string\|null | `null` | The glue string between elements |

```php
$stringable = Collection::make(['Jane', 'John'])->implodeToStringable(', ');
// Stringable of "Jane, John"

$stringable = Collection::make([
    ['name' => 'Jane'],
    ['name' => 'John'],
])->implodeToStringable('name', ', ');
// Stringable of "Jane, John"
```

#### `joinToStringable`

Joins the collection and returns it as a Stringable object.

```php
joinToStringable(string $glue, string $finalGlue = ''): Stringable
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$glue` | string | required | The glue string between elements |
| `$finalGlue` | string | `''` | The glue string before the last element |

```php
$stringable = Collection::make(['Jane', 'John', 'Jack'])->joinToStringable(', ');
// Stringable of "Jane, John, Jack"

$stringable = Collection::make(['Jane', 'John', 'Jack'])->joinToStringable(', ', ' and ');
// Stringable of "Jane, John and Jack"
```

#### `mapToCollection`

Recursively maps all arrays/objects to nested Collection objects.

```php
mapToCollection(array $ary = [], bool $deep = false): Collection
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$ary` | array | `[]` | Additional array to merge |
| `$deep` | bool | `false` | When true, also converts Arrayable objects recursively |

```php
$collection = Collection::make([['test' => 1], 2, 3])->mapToCollection();
$collection->get(0)->get('test'); // returns 1

// With additional data to merge
$collection = Collection::make([['a' => 1]])->mapToCollection(['b' => 2]);

// With deep conversion of Arrayable objects
$collection = Collection::make([$item1, $item2])->mapToCollection(deep: true);
```

#### `mapToCollectionFrom`

Static method to recursively map all arrays/objects to nested Collection objects.

```php
Collection::mapToCollectionFrom(array $ary, bool $deep = false, int $maxDepth = 512): Collection
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$ary` | array | required | The array to convert |
| `$deep` | bool | `false` | When true, also converts Arrayable objects recursively |
| `$maxDepth` | int | `512` | Maximum recursion depth to prevent stack overflow |

```php
$collection = Collection::mapToCollectionFrom([['test' => 1], 2, 3]);
$collection->get(0)->get('test'); // returns 1

// With deep conversion of Arrayable objects
$collection = Collection::mapToCollectionFrom([$item1, $item2], deep: true);
```

#### `odd`

Filters the collection to only integer values and returns the odd ones.

```php
odd(bool $preserveKeys = false): Collection
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$preserveKeys` | bool | `false` | Whether to preserve original array keys |

```php
$collection = Collection::range(0, 6)->odd();
// returns [1, 3, 5]

$collection = Collection::range(0, 6)->odd(preserveKeys: true);
// returns [1 => 1, 3 => 3, 5 => 5]
```

#### `onlyInts`

Filters the collection to only integer values.

```php
onlyInts(bool $preserveKeys = false): Collection
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$preserveKeys` | bool | `false` | Whether to preserve original array keys |

```php
$collection = Collection::make([0, 'Donkey Kong', 6, new stdClass])->onlyInts();
// returns [0, 6]

$collection = Collection::make([0, 'Donkey Kong', 6, new stdClass])->onlyInts(preserveKeys: true);
// returns [0 => 0, 2 => 6]

$collection = Collection::make([-5, 1.5, 3, '4'])->onlyInts();
// returns [-5, 3] (floats and numeric strings are excluded)
```

#### `onlyStrings`

Filters the collection to only string values, optionally converting Stringable objects.

```php
onlyStrings(bool $strict = false, bool $preserveKeys = false): Collection
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$strict` | bool | `false` | When true, only accepts native strings; when false, also converts Stringable objects |
| `$preserveKeys` | bool | `false` | Whether to preserve original array keys |

```php
$collection = Collection::make([0, 'Donkey Kong', 6, 'Bananas'])->onlyStrings();
// returns ['Donkey Kong', 'Bananas']

// With Stringable objects (non-strict mode converts them)
$collection = Collection::make(['Hello', new StringableObject()])->onlyStrings();
// returns ['Hello', 'StringableValue']

// Strict mode rejects Stringable objects
$collection = Collection::make(['Hello', new StringableObject()])->onlyStrings(strict: true);
// returns ['Hello']

// Preserve original keys
$collection = Collection::make(['a' => 'Hello', 'b' => 123, 'c' => 'World'])
    ->onlyStrings(preserveKeys: true);
// returns ['a' => 'Hello', 'c' => 'World']
```

#### `positive`

Returns true if the collection is not empty (has at least one element).

```php
positive(): bool
```

```php
Collection::make([1, 2, 3])->positive(); // returns true
Collection::make()->positive();          // returns false
```

#### `recursiveToArray`

Recursively converts all nested objects with `toArray()` to arrays.

```php
recursiveToArray(array $ary = []): array
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$ary` | array | `[]` | Additional array to merge |

```php
// Objects with toArray() method are recursively converted
$array = Collection::make(['item1' => $object1, 'item2' => $object2])->recursiveToArray();

// With additional data to merge
$array = Collection::make(['a' => $object])->recursiveToArray(['b' => $object2]);
```

#### `recursiveToArrayFrom`

Static method to recursively convert all nested objects with `toArray()` to arrays.

```php
Collection::recursiveToArrayFrom(array $ary, int $maxDepth = 512): array
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$ary` | array | required | The array to convert |
| `$maxDepth` | int | `512` | Maximum recursion depth to prevent stack overflow |

```php
// Objects with toArray() method are recursively converted
$array = Collection::recursiveToArrayFrom(['item1' => $object1, 'item2' => $object2]);
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
