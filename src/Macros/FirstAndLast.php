<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;

/**
 * Returns the first and last element of the collection as an array
 *
 * @param  callable|null  $first  Optional callback to find the first element
 * @param  mixed  $firstDefault  Default value if first element not found
 * @param  callable|null  $last  Optional callback to find the last element
 * @param  mixed  $lastDefault  Default value if last element not found
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return array{0: mixed, 1: mixed}
 */
class FirstAndLast
{
    public function __invoke(): Closure
    {
        return function (
            ?callable $first = null,
            mixed $firstDefault = null,
            ?callable $last = null,
            mixed $lastDefault = null,
        ): array {
            $all = $this->values();

            return [$all->first($first, $firstDefault), $all->last($last, $lastDefault)];
        };
    }
}
