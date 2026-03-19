<?php

namespace Pulli\LaravelCollectionMacros;

use Pulli\LaravelCollectionMacros\Macros\CompareCount;
use Pulli\LaravelCollectionMacros\Macros\Even;
use Pulli\LaravelCollectionMacros\Macros\Explode;
use Pulli\LaravelCollectionMacros\Macros\FirstAndLast;
use Pulli\LaravelCollectionMacros\Macros\FirstAndLastKey;
use Pulli\LaravelCollectionMacros\Macros\ImplodeToStringable;
use Pulli\LaravelCollectionMacros\Macros\JoinToStringable;
use Pulli\LaravelCollectionMacros\Macros\MapToCollection;
use Pulli\LaravelCollectionMacros\Macros\MapToCollectionFrom;
use Pulli\LaravelCollectionMacros\Macros\Odd;
use Pulli\LaravelCollectionMacros\Macros\OnlyInts;
use Pulli\LaravelCollectionMacros\Macros\OnlyStrings;
use Pulli\LaravelCollectionMacros\Macros\Positive;
use Pulli\LaravelCollectionMacros\Macros\RecursiveToArray;
use Pulli\LaravelCollectionMacros\Macros\RecursiveToArrayFrom;

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
            'compareCount' => CompareCount::class,
            'even' => Even::class,
            'explode' => Explode::class,
            'firstAndLast' => FirstAndLast::class,
            'firstAndLastKey' => FirstAndLastKey::class,
            'implodeToStringable' => ImplodeToStringable::class,
            'joinToStringable' => JoinToStringable::class,
            'mapToCollection' => MapToCollection::class,
            'mapToCollectionFrom' => MapToCollectionFrom::class,
            'odd' => Odd::class,
            'onlyInts' => OnlyInts::class,
            'onlyStrings' => OnlyStrings::class,
            'positive' => Positive::class,
            'recursiveToArray' => RecursiveToArray::class,
            'recursiveToArrayFrom' => RecursiveToArrayFrom::class,
        ];
    }
}
