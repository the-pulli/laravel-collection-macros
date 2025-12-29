<?php

use Illuminate\Support\Collection;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\ChildObject;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\OtherObject;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\ParentObject;

it('wraps nested collection and objects into array', function () {
    $data = Collection::recursiveToArrayFrom([
        new ParentObject(
            name: 'parent1',
            children: Collection::make([new ChildObject(name: 'child1')]),
            other: Collection::make([new OtherObject(value: 'other1')]),
        ),
        new ParentObject(
            name: 'parent2',
            children: Collection::make([new ChildObject(name: 'child2')]),
            other: Collection::make([new OtherObject(value: 'other2')]),
        ),
    ]);

    expect($data)->toBe([
        [
            'name' => 'parent1',
            'children' => [
                ['name' => 'child1'],
            ],
            'other' => [
                ['value' => 'other1'],
            ],
        ],
        [
            'name' => 'parent2',
            'children' => [
                ['name' => 'child2'],
            ],
            'other' => [
                ['value' => 'other2'],
            ],
        ],
    ]);
});
