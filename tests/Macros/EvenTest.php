<?php

use Illuminate\Support\Collection;

it('returns only the even items', function () {
    $actual = Collection::range(0, 6)->even();

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe([0, 2, 4, 6]);
});

it('returns only the even items and preserves the original keys', function () {
    $actual = Collection::range(0, 6)->even(true);

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe([
            0 => 0,
            2 => 2,
            4 => 4,
            6 => 6,
        ]);
});

it('rejects non integer values', function () {
    $actual = Collection::make([new stdClass, []])->even();

    expect($actual->toArray())->toBe([]);
});
