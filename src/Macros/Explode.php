<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

use function explode;

class Explode
{
    public function __invoke(): Closure
    {
        return function (string $separator, string $string, int $limit = PHP_INT_MAX): Collection {
            return static::make(explode($separator, $string, $limit));
        };
    }
}
