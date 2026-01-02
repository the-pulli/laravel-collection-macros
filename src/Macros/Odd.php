<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Returns odd integers as Collection
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection<int, int>
 */
class Odd
{
    public function __invoke(): Closure
    {
        return function (bool $preserveKeys = false): Collection {
            $odd = $this->filter(fn (mixed $value): bool => is_int($value))
                ->reject(fn (int $value): bool => $value % 2 === 0);

            return $preserveKeys ? $odd : $odd->values();
        };
    }
}
