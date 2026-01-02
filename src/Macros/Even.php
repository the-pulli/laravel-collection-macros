<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Returns even integers as Collection
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection<int, int>
 */
class Even
{
    public function __invoke(): Closure
    {
        return function (bool $preserveKeys = false): Collection {
            $even = $this->filter(fn (mixed $value): bool => is_int($value))
                ->filter(fn (int $value): bool => $value % 2 === 0);

            return $preserveKeys ? $even : $even->values();
        };
    }
}
