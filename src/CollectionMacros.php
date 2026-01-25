<?php

namespace Pulli\LaravelCollectionMacros;

/**
 * Registry of all available collection macros
 *
 * Maps macro names to their implementing classes.
 */
class CollectionMacros
{
    /**
     * Get all registered macro name to class mappings
     *
     * @return array<string, class-string>
     */
    public function all(): array
    {
        return [
            'compareCount' => \Pulli\LaravelCollectionMacros\Macros\CompareCount::class,
            'even' => \Pulli\LaravelCollectionMacros\Macros\Even::class,
            'explode' => \Pulli\LaravelCollectionMacros\Macros\Explode::class,
            'firstAndLast' => \Pulli\LaravelCollectionMacros\Macros\FirstAndLast::class,
            'firstAndLastKey' => \Pulli\LaravelCollectionMacros\Macros\FirstAndLastKey::class,
            'implodeToStringable' => \Pulli\LaravelCollectionMacros\Macros\ImplodeToStringable::class,
            'joinToStringable' => \Pulli\LaravelCollectionMacros\Macros\JoinToStringable::class,
            'mapToCollection' => \Pulli\LaravelCollectionMacros\Macros\MapToCollection::class,
            'mapToCollectionFrom' => \Pulli\LaravelCollectionMacros\Macros\MapToCollectionFrom::class,
            'odd' => \Pulli\LaravelCollectionMacros\Macros\Odd::class,
            'onlyInts' => \Pulli\LaravelCollectionMacros\Macros\OnlyInts::class,
            'onlyStrings' => \Pulli\LaravelCollectionMacros\Macros\OnlyStrings::class,
            'positive' => \Pulli\LaravelCollectionMacros\Macros\Positive::class,
            'recursiveToArray' => \Pulli\LaravelCollectionMacros\Macros\RecursiveToArray::class,
            'recursiveToArrayFrom' => \Pulli\LaravelCollectionMacros\Macros\RecursiveToArrayFrom::class,
        ];
    }
}
