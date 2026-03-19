<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Pulli\LaravelCollectionMacros\Helper;

/**
 * Compares the count of the collection with another countable and optionally zips them
 *
 * @param  mixed  $countable  An array, Countable, or object with count() method
 * @param  bool  $shouldZip  When true, returns zipped collection; when false, returns original collection (default true)
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return ($shouldZip is true ? \Illuminate\Support\Collection<int, array<mixed>> : \Illuminate\Support\Collection<array-key, mixed>)
 *
 * @throws \InvalidArgumentException When counts do not match
 */
class CompareCount
{
    public function __invoke(): Closure
    {
        return function (mixed $countable, bool $shouldZip = true): Collection {
            if (Helper::isArrayable($countable)) {
                $countable = $countable->toArray();
            }

            if ($this->count() !== Helper::count($countable)) {
                throw new InvalidArgumentException('Count of input mismatch with given collection.');
            }

            return $shouldZip ? $this->zip($countable) : $this;
        };
    }
}
