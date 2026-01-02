<?php

namespace Pulli\LaravelCollectionMacros;

class CollectionMacros
{
    public function all(): array
    {
        return [
            'even' => \Pulli\LaravelCollectionMacros\Macros\Even::class,
            'firstAndLast' => \Pulli\LaravelCollectionMacros\Macros\FirstAndLast::class,
            'firstAndLastKey' => \Pulli\LaravelCollectionMacros\Macros\FirstAndLastKey::class,
            'implodeToStringable' => \Pulli\LaravelCollectionMacros\Macros\ImplodeToStringable::class,
            'joinToStringable' => \Pulli\LaravelCollectionMacros\Macros\JoinToStringable::class,
            'mapToCollection' => \Pulli\LaravelCollectionMacros\Macros\MapToCollection::class,
            'mapToCollectionFrom' => \Pulli\LaravelCollectionMacros\Macros\MapToCollectionFrom::class,
            'odd' => \Pulli\LaravelCollectionMacros\Macros\Odd::class,
            'positive' => \Pulli\LaravelCollectionMacros\Macros\Positive::class,
            'recursiveToArray' => \Pulli\LaravelCollectionMacros\Macros\RecursiveToArray::class,
            'recursiveToArrayFrom' => \Pulli\LaravelCollectionMacros\Macros\RecursiveToArrayFrom::class,
        ];
    }
}
