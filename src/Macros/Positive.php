<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;

/**
 * Returns true if the collection has more than one element
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
