<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;
use Stringable;

/**
 * Filters the collection to only string values (optionally converting Stringable objects)
 *
 * @param  bool  $strict  When true, only accepts native strings; when false, also converts Stringable objects (default false)
 * @param  bool  $preserveKeys  Whether to preserve original array keys (default false)
 *
 * @mixin Collection
 *
 * @return Collection<int|string, string>
 */
class OnlyStrings
{
    public function __invoke(): Closure
    {
        $isStringable = function (mixed $value): bool {
            return $value instanceof Stringable || (is_object($value) && method_exists($value, '__toString'));
        };

        return function (bool $strict = false, bool $preserveKeys = false) use ($isStringable): Collection {
            $strings = $this
                ->filter(fn (mixed $value): bool => $strict ? is_string($value) : (is_string($value) || $isStringable($value)))
                ->map(fn (mixed $value): string => $isStringable($value) ? $value->__toString() : $value);

            return $preserveKeys ? $strings : $strings->values();
        };
    }
}
