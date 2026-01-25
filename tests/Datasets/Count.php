<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

dataset('valid-countable', [
    'array' => [['Void', 'Kong']],
    'collection' => [Collection::make(['Void', 'Kong'])],
    'object_without_countable' => [new class
    {
        public function count(): int
        {
            return 2;
        }

        public function toArray(): array
        {
            return ['Void', 'Kong'];
        }
    }],
    'object_with_countable' => [new class implements Arrayable, Countable
    {
        public function count(): int
        {
            return 2;
        }

        public function toArray(): array
        {
            return ['Void', 'Kong'];
        }
    }],
]);

dataset('invalid-countable', [
    'array' => [['Void', 'Kong', 'II']],
    'collection' => [Collection::make(['Void', 'Kong', 'II'])],
    'object_without_countable' => [new class
    {
        public function count(): int
        {
            return 3;
        }
    }],
    'object_with_countable' => [new class implements Countable
    {
        public function count(): int
        {
            return 3;
        }
    }],
]);
