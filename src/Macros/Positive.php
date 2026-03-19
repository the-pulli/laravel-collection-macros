<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;

/**
 * Returns true if the collection has at least one element (i.e. is not empty).
 * Named "positive" to convey a collection with a positive item count.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class Positive
{
    public function __invoke(): Closure
    {
        return function (): bool {
            return $this->isNotEmpty();
        };
    }
}
