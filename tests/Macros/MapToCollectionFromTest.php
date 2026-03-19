<?php

use Illuminate\Support\Collection;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\ChildObject;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\OtherObject;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\ParentObject;
use Pulli\LaravelCollectionMacros\Tests\TestDataObjects\TestObject;

it('returns empty collection for empty input', function () {
    $data = Collection::mapToCollectionFrom([]);

    expect($data)->toBeInstanceOf(Collection::class)
        ->and($data->isEmpty())->toBeTrue();
});

it('wraps top-level items without recursion when maxDepth is zero', function () {
    $data = Collection::mapToCollectionFrom([
        ['nested' => ['deep' => 'value']],
    ], false, 0);

    expect($data)->toBeInstanceOf(Collection::class)
        ->and($data[0])->toBeArray();
});

it('only converts first level when maxDepth is one', function () {
    $data = Collection::mapToCollectionFrom([
        ['nested' => ['deep' => 'value']],
    ], false, 1);

    expect($data[0])->toBeInstanceOf(Collection::class)
        ->and($data[0]['nested'])->toBeArray();
});

it('wraps all arrays into collection objects', function () {
    $data = Collection::mapToCollectionFrom([
        ['test' => ['test' => '1.1']],
        ['test' => ['test' => '1.2']],
        ['test' => ['test' => ['test' => '1.3.1']]],
    ]);

    expect($data[0])->toBeInstanceOf(Collection::class)
        ->and($data[1])->toBeInstanceOf(Collection::class)
        ->and($data[0]['test'])->toBeInstanceOf(Collection::class)
        ->and($data[1]['test'])->toBeInstanceOf(Collection::class)
        ->and($data->get(0)->get('test')->get('test'))->toBe('1.1')
        ->and($data->get(1)->get('test')->get('test'))->toBe('1.2')
        ->and($data->get(2)->get('test')->get('test')->get('test'))->toBe('1.3.1');
});

it('wraps data objects into collection objects', function () {
    $data = Collection::mapToCollectionFrom([
        new TestObject('John Doe', 'Programmer'),
        new TestObject('Jane Doe', 'Designer'),
    ], true);

    expect($data[0])->toBeInstanceOf(Collection::class)
        ->and($data[1])->toBeInstanceOf(Collection::class)
        ->and($data->get(0))->toEqual(new Collection([
            'name' => 'John Doe',
            'job' => 'Programmer',
        ]))
        ->and($data->get(1))->toEqual(new Collection([
            'name' => 'Jane Doe',
            'job' => 'Designer',
        ]));
});

it('wraps nested data objects into collection objects', function () {
    $data = Collection::mapToCollectionFrom([
        ['first' => new TestObject('John Doe', 'Programmer')],
        ['second' => new TestObject('Jane Doe', 'Designer')],
    ], true);

    expect($data[0])->toBeInstanceOf(Collection::class)
        ->and($data[1])->toBeInstanceOf(Collection::class)
        ->and($data->get(0)->get('first'))->toEqual(new Collection([
            'name' => 'John Doe',
            'job' => 'Programmer',
        ]))
        ->and($data->get(1)->get('second'))->toEqual(new Collection([
            'name' => 'Jane Doe',
            'job' => 'Designer',
        ]));
});

it('wraps nested arrays and objects into collection objects', function () {
    $data = Collection::mapToCollectionFrom([
        new ParentObject(
            name: 'parent1',
            children: new Collection([new ChildObject(name: 'child1')]),
            other: new Collection([new OtherObject(value: 'other1')]),
        ),
        new ParentObject(
            name: 'parent2',
            children: new Collection([new ChildObject(name: 'child2')]),
            other: new Collection([new OtherObject(value: 'other2')]),
        ),
    ], true);

    expect($data)->toEqual(new Collection([
        new Collection([
            'name' => 'parent1',
            'children' => new Collection([
                new Collection(['name' => 'child1']),
            ]),
            'other' => new Collection([
                new Collection(['value' => 'other1']),
            ]),
        ]),
        new Collection([
            'name' => 'parent2',
            'children' => new Collection([
                new Collection(['name' => 'child2']),
            ]),
            'other' => new Collection([
                new Collection(['value' => 'other2']),
            ]),
        ]),
    ]));
});
