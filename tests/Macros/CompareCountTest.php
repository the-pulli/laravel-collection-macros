<?php

use Illuminate\Support\Collection;

it('returns the given zipped collection if count matches', function (mixed $countable) {
    $actual = Collection::make(['Donkey', 'Kong'])->compareCount($countable);

    expect($actual->toArray())->toBe([
        ['Donkey', 'Void'],
        ['Kong', 'Kong'],
    ]);
})->with('valid-countable');

it('returns the given collection if count matches', function (mixed $countable) {
    $actual = Collection::make(['Donkey', 'Kong'])->compareCount($countable, false);

    expect($actual->toArray())->toBe(['Donkey', 'Kong']);
})->with('valid-countable');

it('throws an exception if countable does not match', function (mixed $countable) {
    Collection::make(['Donkey', 'Kong'])->compareCount($countable);
})->with('invalid-countable')->throws(InvalidArgumentException::class, 'Count of input mismatch with given collection.');

it('returns empty zipped collection when both sides are empty', function () {
    $actual = Collection::make([])->compareCount([]);

    expect($actual->toArray())->toBe([]);
});

it('returns empty collection when both sides are empty and shouldZip is false', function () {
    $actual = Collection::make([])->compareCount([], false);

    expect($actual->toArray())->toBe([]);
});
