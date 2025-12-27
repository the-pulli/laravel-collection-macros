<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Returns all items as Collections
 *
 * @param  array  $ary
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection<mixed, \Illuminate\Support\Collection>
 */
class MapToCollection
{
    public function __invoke(): Closure
    {
        return function (array $ary = [], bool $deep = false): Collection {
            $ary = static::mapToCollectionFrom($ary, $deep);
            $data = static::mapToCollectionFrom($this->all(), $deep);

            if ($ary->isNotEmpty()) {
                return $data->merge([$ary]);
            }

            return $data;
        };
    }
}
