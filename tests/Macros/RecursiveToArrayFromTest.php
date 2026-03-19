<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\ChildObject;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\OtherObject;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\ParentObject;

it('returns empty array for empty input', function () {
    expect(Collection::recursiveToArrayFrom([]))->toBe([]);
});

it('returns input unchanged when maxDepth is zero', function () {
    $parent = new ParentObject(
        name: 'parent1',
        children: Collection::make([new ChildObject(name: 'child1')]),
        other: Collection::make([new OtherObject(value: 'other1')]),
    );

    $data = Collection::recursiveToArrayFrom([$parent], 0);

    expect($data[0])->toBeInstanceOf(ParentObject::class);
});

it('only converts one level deep when maxDepth is one', function () {
    $inner = new class
    {
        public function toArray(): array
        {
            return ['key' => 'value'];
        }
    };

    $outer = new class($inner) implements Arrayable
    {
        public function __construct(private readonly object $inner) {}

        public function toArray(): array
        {
            return ['inner' => $this->inner];
        }
    };

    $data = Collection::recursiveToArrayFrom([$outer], 1);

    expect($data[0])->toBeArray()
        ->and($data[0]['inner'])->toBeObject();
});

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
