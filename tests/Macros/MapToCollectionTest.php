<?php

use Illuminate\Support\Collection;
use Pulli\LaravelCollectionMacros\Tests\Data\ChildObject;
use Pulli\LaravelCollectionMacros\Tests\Data\OtherObject;
use Pulli\LaravelCollectionMacros\Tests\Data\ParentObject;
use Pulli\LaravelCollectionMacros\Tests\Data\TestObject;

describe('mapToCollection macro', function () {
    it('wraps all arrays into collection objects', function () {
        $data = Collection::make([
            ['test' => ['test' => '1.1']],
            ['test' => ['test' => '1.2']],
            ['test' => ['test' => ['test' => '1.3.1']]],
        ])->mapToCollection();

        expect($data[0])->toBeInstanceOf(Collection::class)
            ->and($data[1])->toBeInstanceOf(Collection::class)
            ->and($data[0]['test'])->toBeInstanceOf(Collection::class)
            ->and($data[1]['test'])->toBeInstanceOf(Collection::class)
            ->and($data->get(0)->get('test')->get('test'))->toBe('1.1')
            ->and($data->get(1)->get('test')->get('test'))->toBe('1.2')
            ->and($data->get(2)->get('test')->get('test')->get('test'))->toBe('1.3.1');
    });

    it('wraps data objects into collection objects', function () {
        $data = Collection::make([
            new TestObject('John Doe', 'Programmer'),
            new TestObject('Jane Doe', 'Designer'),
        ])->mapToCollection([], true);

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
        $data = Collection::make([
            ['first' => new TestObject('John Doe', 'Programmer')],
            ['second' => new TestObject('Jane Doe', 'Designer')],
        ])->mapToCollection([], true);

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
        $data = Collection::make([
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
        ])->mapToCollection([], true);

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

    it('merges additional data to the given one', function () {
        $data = Collection::make([
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
        ])->mapToCollection(['hello' => 'world'], true);

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
            new Collection(['hello' => 'world']),
        ]));
    });
});
