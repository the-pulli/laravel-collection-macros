<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Filters the collection to only odd integer values
 *
 * @param  bool  $preserveKeys  Whether to preserve original array keys (default false)
 *
 * @mixin Collection
 *
 * @return Collection<int|string, int>
 */
class Odd
{
    public function __invoke(): Closure
    {
        return function (bool $preserveKeys = false): Collection {
            $odd = $this->onlyInts()->reject(fn (int $value): bool => $value % 2 === 0);

            return $preserveKeys ? $odd : $odd->values();
        };
    }
}
