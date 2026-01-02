<?php

use Illuminate\Support\Collection;

it('returns only the odd items', function () {
    $actual = Collection::range(0, 6)->odd();

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe([1, 3, 5]);
});

it('returns only the odd items and preserves the original keys', function () {
    $actual = Collection::range(0, 6)->odd(true);

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe([
            1 => 1,
            3 => 3,
            5 => 5,
        ]);
});

it('rejects non integer values', function () {
    $actual = Collection::make([new stdClass, []])->odd();

    expect($actual->toArray())->toBe([]);
});
