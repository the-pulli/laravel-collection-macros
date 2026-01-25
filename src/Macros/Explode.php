<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

use function explode;

/**
 * Creates a collection from an exploded string
 *
 * @param  string  $separator  The delimiter string
 * @param  string  $string  The input string to split
 * @param  int  $limit  Maximum number of elements (default PHP_INT_MAX)
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection<int, string>
 */
class Explode
{
    public function __invoke(): Closure
    {
        return function (string $separator, string $string, int $limit = PHP_INT_MAX): Collection {
            return static::make(explode($separator, $string, $limit));
        };
    }
}
