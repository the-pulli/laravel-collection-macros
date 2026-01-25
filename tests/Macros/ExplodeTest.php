<?php

use Illuminate\Support\Collection;

it('returns a collection from delimited string', function () {
    $actual = Collection::explode(';', 'Twenty;Banana;Boats');

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe(['Twenty', 'Banana', 'Boats']);
});

it('respects the limit parameter', function () {
    $actual = Collection::explode(';', 'Twenty;Banana;Boats', 2);

    expect($actual->toArray())->toBe(['Twenty', 'Banana;Boats']);
});

it('handles negative limit parameter', function () {
    $actual = Collection::explode(';', 'Twenty;Banana;Boats', -1);

    expect($actual->toArray())->toBe(['Twenty', 'Banana']);
});
