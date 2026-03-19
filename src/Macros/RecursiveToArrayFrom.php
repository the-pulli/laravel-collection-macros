<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;
use Pulli\LaravelCollectionMacros\Helper;

use function array_walk;
use function is_array;

/**
 * Static method to recursively convert all nested objects with toArray() to arrays
 *
 * @param  array  $ary  The array to convert
 * @param  int  $maxDepth  Maximum recursion depth to prevent stack overflow (default 512)
 *
 * @mixin Collection
 *
 * @return array<mixed, mixed>
 */
class RecursiveToArrayFrom
{
    public const MAX_DEPTH = 512;

    public function __invoke(): Closure
    {
        return function (array $ary, int $maxDepth = RecursiveToArrayFrom::MAX_DEPTH): array {
            if ($maxDepth <= 0) {
                return $ary;
            }

            $closure = function (&$ary) use ($maxDepth) {
                if (is_array($ary)) {
                    $ary = static::recursiveToArrayFrom($ary, $maxDepth - 1);
                }

                if (Helper::isArrayable($ary)) {
                    $ary = static::recursiveToArrayFrom($ary->toArray(), $maxDepth - 1);
                }
            };

            array_walk($ary, $closure);

            return $ary;
        };
    }
}
