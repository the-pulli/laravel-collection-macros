<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class ImplodeToStringable
{
    public function __invoke(): Closure
    {
        return function ($value, $glue = null): Stringable {
            return Str::of($this->implode($value, $glue));
        };
    }
}
