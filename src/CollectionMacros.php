<?php

namespace Pulli\LaravelCollectionMacros;

class CollectionMacros
{
    public function all(): array
    {
        return [
            'implodeToStringable' => \Pulli\LaravelCollectionMacros\Macros\ImplodeToStringable::class,
            'joinToStringable' => \Pulli\LaravelCollectionMacros\Macros\JoinToStringable::class,
            'mapToCollection' => \Pulli\LaravelCollectionMacros\Macros\MapToCollection::class,
            'mapToCollectionFrom' => \Pulli\LaravelCollectionMacros\Macros\MapToCollectionFrom::class,
            'positive' => \Pulli\LaravelCollectionMacros\Macros\Positive::class,
            'recursiveToArray' => \Pulli\LaravelCollectionMacros\Macros\RecursiveToArray::class,
            'recursiveToArrayFrom' => \Pulli\LaravelCollectionMacros\Macros\RecursiveToArrayFrom::class,
        ];
    }
}
