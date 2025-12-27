<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;

/**
 * Returns recursively all items to array
 *
 * @param  array  $ary
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return array<mixed, array>
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
