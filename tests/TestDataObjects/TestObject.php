<?php

namespace Pulli\LaravelCollectionMacros\Tests\TestDataObjects;

readonly class TestObject
{
    public function __construct(
        private string $name,
        private string $job,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'job' => $this->job,
        ];
    }
}
