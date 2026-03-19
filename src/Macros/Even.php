<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Filters the collection to only even integer values
 *
 * @param  bool  $preserveKeys  Whether to preserve original array keys (default false)
 *
 * @mixin Collection
 *
 * @return Collection<int|string, int>
 */
class Even
{
    public function __invoke(): Closure
    {
        return function (bool $preserveKeys = false): Collection {
            $even = $this->onlyInts()->filter(fn (int $value): bool => $value % 2 === 0);

            return $preserveKeys ? $even : $even->values();
        };
    }
}
