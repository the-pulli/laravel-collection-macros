<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Returns the first and last key of the collection as an array
 *
 * @param  callable|null  $first  Optional callback to find the first key
 * @param  mixed  $firstDefault  Default value if first key not found
 * @param  callable|null  $last  Optional callback to find the last key
 * @param  mixed  $lastDefault  Default value if last key not found
 *
 * @mixin Collection
 *
 * @return array{0: mixed, 1: mixed}
 */
class FirstAndLastKey
{
    public function __invoke(): Closure
    {
        return function (
            ?callable $first = null,
            mixed $firstDefault = null,
            ?callable $last = null,
            mixed $lastDefault = null,
        ): array {
            $all = $this->keys();

            return [$all->first($first, $firstDefault), $all->last($last, $lastDefault)];
        };
    }
}
