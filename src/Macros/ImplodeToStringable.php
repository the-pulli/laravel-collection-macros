<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Returns imploded elements as Stringable
 *
 * @param  callable|string|null  $value  The key to implode or a callback
 * @param  string|null  $glue  The glue string between elements
 *
 * @mixin Collection
 *
 * @return Stringable
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
