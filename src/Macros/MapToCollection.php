<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Recursively maps all arrays/objects to nested Collection objects
 *
 * @param  array  $ary  Additional array to merge (default [])
 * @param  bool  $deep  When true, also converts Arrayable objects recursively (default false)
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection<mixed, mixed>
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
