<?php

namespace Pulli\LaravelCollectionMacros\Tests\TestDataObjects;

readonly class OtherObject
{
    public function __construct(private string $value) {}

    public function toArray(): array
    {
        return [
            'value' => $this->value,
        ];
    }
}
