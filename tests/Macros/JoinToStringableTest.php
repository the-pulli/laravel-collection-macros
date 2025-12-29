<?php

use Illuminate\Support\Collection;

it('returns the glued items as stringable', function (Collection $names) {
    $actual = $names->joinToStringable(', ');

    checkStringableExpectations($actual, expected: 'Taylor, Freek, Caleb are awesome!');
})->with('stringable');

it('returns the glued items wit final glue as stringable', function (Collection $names) {
    $actual = $names->joinToStringable(', ', ' and ');

    checkStringableExpectations($actual, expected: 'Taylor, Freek and Caleb are awesome!');
})->with('stringable');
