<?php

use Illuminate\Support\Collection;

it('returns only the integer items', function () {
    $actual = Collection::make([0, 'Donkey Kong', 6, new stdClass])->onlyInts();

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe([0, 6]);
});

it('returns only the integer items and preserves the original keys', function () {
    $actual = Collection::make([0, 'Donkey Kong', 6, new stdClass])->onlyInts(true);

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe([
            0 => 0,
            2 => 6,
        ]);
});

it('rejects non integer values', function () {
    $actual = Collection::make([new stdClass, []])->onlyInts();

    expect($actual->toArray())->toBe([]);
});

it('includes negative integers', function () {
    $actual = Collection::make([-5, -1, 0, 1, 5])->onlyInts();

    expect($actual->toArray())->toBe([-5, -1, 0, 1, 5]);
});

it('rejects float values', function () {
    $actual = Collection::make([1.5, 2.0, 3, '4'])->onlyInts();

    expect($actual->toArray())->toBe([3]);
});

it('returns empty collection for empty input', function () {
    $actual = Collection::make([])->onlyInts();

    expect($actual->toArray())->toBe([]);
});
