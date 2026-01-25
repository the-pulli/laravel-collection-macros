<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;

/**
 * Recursively converts all nested objects with toArray() to arrays
 *
 * @param  array  $ary  Additional array to merge (default [])
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return array<mixed, mixed>
 */
class RecursiveToArray
{
    public function __invoke(): Closure
    {
        return function (array $ary = []): array {
            return array_merge(
                static::recursiveToArrayFrom($this->all()),
                static::recursiveToArrayFrom($ary)
            );
        };
    }
}
