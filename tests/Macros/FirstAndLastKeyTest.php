<?php

use Illuminate\Support\Collection;

it('returns the first and last item of the collection as array', function () {
    $data = Collection::make([1, 2, 3, 'Banana']);

    expect($data->firstAndLastKey())->toBe([0, 3]);
});

it('returns the custom first and last item of the collection as array', function () {
    $data = Collection::range(0, 6);

    expect($data->firstAndLast(
        first: fn ($value) => $value > 0,
        last: fn ($value) => $value < 6,
    ))->toBe([1, 5]);
});
