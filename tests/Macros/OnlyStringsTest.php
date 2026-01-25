<?php

use Illuminate\Support\Collection;

it('returns only the integer items', function () {
    $actual = Collection::make([0, 'Donkey Kong', 6, new stdClass, 'Bananas'])->onlyStrings();

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe(['Donkey Kong', 'Bananas']);
});

it('returns only the string items and preserves the original keys', function () {
    $actual = Collection::make([0, 'Donkey Kong', 6, new stdClass, 'Bananas'])->onlyStrings(preserveKeys: true);

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe([
            1 => 'Donkey Kong',
            4 => 'Bananas',
        ]);
});

it('can convert objects to strings', function () {
    $actual = Collection::make([666, stringableClass(), toStringClass()])->onlyStrings();

    expect($actual->toArray())->toBe(['Donkey Kong', 'Bananas']);
});

it('can reject stringable objects in strict mode', function () {
    $actual = Collection::make(['Void Kong', stringableClass(), toStringClass()])->onlyStrings(true);

    expect($actual->toArray())->toBe(['Void Kong']);
});

it('can switch to integer keys', function () {
    $actual = Collection::make(['boss' => 'Void Kong'])->onlyStrings();

    expect($actual->toArray())->toBe(['Void Kong'])
        ->and($actual->keys()->toArray())->toBe([0]);
});

it('can use strict mode with preserved keys', function () {
    $actual = Collection::make(['a' => 'Void Kong', 'b' => stringableClass(), 'c' => 'Bananas'])->onlyStrings(strict: true, preserveKeys: true);

    expect($actual->toArray())->toBe([
        'a' => 'Void Kong',
        'c' => 'Bananas',
    ]);
});

it('returns empty collection for empty input', function () {
    $actual = Collection::make([])->onlyStrings();

    expect($actual->toArray())->toBe([]);
});

function stringableClass(): object
{
    return new class implements Stringable
    {
        public function __toString()
        {
            return 'Donkey Kong';
        }
    };
}

function toStringClass(): object
{
    return new class
    {
        public function __toString()
        {
            return 'Bananas';
        }
    };
}
