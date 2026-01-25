<?php

use Illuminate\Support\Collection;

it('returns true for a collection with more than 0 items', function () {
    $actual = Collection::make(['test'])->positive();

    expect($actual)->toBeTrue();
});

it('returns false for a collection with 0 items', function () {
    $actual = Collection::make()->positive();

    expect($actual)->toBeFalse();
});
