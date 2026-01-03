<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Pulli\LaravelCollectionMacros\IsArrayable;

use function array_walk;
use function is_array;

/**
 * Returns recursively all items to array from the given array
 *
 * @param  array  $ary
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return array<mixed, array>
 */
class RecursiveToArrayFrom
{
    public function __invoke(): Closure
    {
        return function (array $ary): array {
            $closure = function (&$ary) {
                if (is_array($ary)) {
                    $ary = static::recursiveToArrayFrom($ary);
                }

                if (IsArrayable::check($ary)) {
                    $ary = static::recursiveToArrayFrom($ary->toArray());
                }
            };

            array_walk($ary, $closure);

            return $ary;
        };
    }
}
