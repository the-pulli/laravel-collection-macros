<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Returns imploded elements as Stringable
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Stringable
 */
class ImplodeToStringable
{
    public function __invoke(): Closure
    {
        return function (callable|null|string $value, ?string $glue = null): Stringable {
            return Str::of($this->implode($value, $glue));
        };
    }
}
