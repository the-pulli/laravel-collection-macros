<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;
use Pulli\LaravelCollectionMacros\Helper;

use function array_walk;
use function is_array;

/**
 * Static method to recursively map all arrays/objects to nested Collection objects
 *
 * @param  array  $ary  The array to convert
 * @param  bool  $deep  When true, also converts Arrayable objects recursively (default false)
 * @param  int  $maxDepth  Maximum recursion depth to prevent stack overflow (default 512)
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection<mixed, mixed>
 */
class MapToCollectionFrom
{
    public const MAX_DEPTH = 512;

    public function __invoke(): Closure
    {
        return function (array $ary, bool $deep = false, int $maxDepth = MapToCollectionFrom::MAX_DEPTH): Collection {
            if ($maxDepth <= 0) {
                return static::make($ary);
            }

            $closure = function (&$ary) use ($deep, $maxDepth) {
                if (is_array($ary)) {
                    $ary = static::mapToCollectionFrom($ary, $deep, $maxDepth - 1);
                }

                if ($deep && Helper::isArrayable($ary)) {
                    $ary = static::mapToCollectionFrom($ary->toArray(), $deep, $maxDepth - 1);
                }
            };

            array_walk($ary, $closure);

            return static::make($ary);
        };
    }
}
