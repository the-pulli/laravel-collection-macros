<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Filters the collection to only integer values
 *
 * @param  bool  $preserveKeys  Whether to preserve original array keys (default false)
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection<int|string, int>
 */
class OnlyInts
{
    public function __invoke(): Closure
    {
        return function (bool $preserveKeys = false): Collection {
            $ints = $this->filter(fn (mixed $value): bool => is_int($value));

            return $preserveKeys ? $ints : $ints->values();
        };
    }
}
