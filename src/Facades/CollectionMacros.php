<?php

namespace Pulli\LaravelCollectionMacros\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pulli\LaravelCollectionMacros\CollectionMacros
 */
class CollectionMacros extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Pulli\LaravelCollectionMacros\CollectionMacros::class;
    }
}
