<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Returns joined elements as Stringable
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Stringable
 */
class JoinToStringable
{
    public function __invoke(): Closure
    {
        return function (string $glue, string $finalGlue = ''): Stringable {
            return Str::of($this->join($glue, $finalGlue));
        };
    }
}
