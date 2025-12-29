<?php

use Illuminate\Support\Collection;

it('returns true for a collection with more than 0 items', function () {
    $data = Collection::make(['test']);

    expect($data->positive())->toBeTrue();
});

it('returns false for a collection with 0 items', function () {
    $data = Collection::make();

    expect($data->positive())->toBeFalse();
});
