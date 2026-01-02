<?php

use Illuminate\Support\Collection;

it('returns a collection from deli-metered string', function () {
    $actual = Collection::explode(';', 'Twenty;Banana;Boats');

    expect($actual)->toBeInstanceOf(Collection::class)
        ->and($actual->toArray())->toBe(['Twenty', 'Banana', 'Boats']);
});
