<?php

use Illuminate\Support\Collection;

it('returns the imploded items as stringable', function (Collection $names) {
    $actual = $names->implodeToStringable(', ');

    checkStringableExpectations($actual, expected: 'Taylor, Freek, Caleb are awesome!');
})->with('stringable');

it('returns the modified imploded items as stringable with defined glue', function (Collection $names) {
    $actual = $names->implodeToStringable(fn (string $name) => mb_strtoupper($name), ', ');

    checkStringableExpectations($actual, expected: 'TAYLOR, FREEK, CALEB are awesome!');
})->with('stringable');

it('returns glued values for given array key', function () {
    $actual = Collection::make([
        ['fruits' => 'Bananas', 'vehicles' => 'Boats'],
        ['fruits' => 'Apples', 'vehicles' => 'Cars'],
    ])->implodeToStringable('fruits', ' and ');

    checkStringableExpectations($actual, expected: 'Bananas and Apples are awesome!');
});

it('returns stringable with initial content glued together for null input', function () {
    $actual = Collection::make(['Banana', 'Boats'])->implodeToStringable(null);

    checkStringableExpectations($actual, expected: 'BananaBoats are awesome!');
});

it('returns an empty stringable for an empty collection', function () {
    $actual = Collection::make()->implodeToStringable(', ');

    expect($actual)->toBeInstanceOf(Stringable::class)
        ->and($actual->toString())->toBe('');
});
