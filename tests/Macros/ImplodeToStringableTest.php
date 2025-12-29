<?php

use Illuminate\Support\Collection;

it('returns the imploded items as stringable', function (Collection $names) {
    $actual = $names->implodeToStringable(', ');

    checkStringableExpectations($actual, expected: 'Taylor, Freek, Caleb are awesome!');
})->with('stringable');

it('returns the modified imploded items as stringable with defined glue', function (Collection $names) {
    $actual = $names->implodeToStringable(fn (string $name) => strtoupper($name), ', ');

    checkStringableExpectations($actual, expected: 'TAYLOR, FREEK, CALEB are awesome!');
})->with('stringable');
