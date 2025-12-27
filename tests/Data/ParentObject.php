<?php

namespace Pulli\LaravelCollectionMacros\Tests\Data;

use Illuminate\Support\Collection;

readonly class ParentObject
{
    public function __construct(
        private string $name,
        private Collection $children,
        private Collection $other,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'children' => $this->children->toArray(),
            'other' => $this->other->toArray(),
        ];
    }
}
