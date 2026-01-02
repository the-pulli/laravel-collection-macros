<?php

namespace Pulli\LaravelCollectionMacros\Macros;

use Closure;

/**
 * Returns odd integers as Collection
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return array<int, mixed>
 */
class FirstAndLast
{
    public function __invoke(): Closure
    {
        return function (
            ?callable $first = null,
            mixed $firstDefault = null,
            ?callable $last = null,
            mixed $lastDefault = null,
        ): array {
            $all = $this->values();

            return [$all->first($first, $firstDefault), $all->last($last, $lastDefault)];
        };
    }
}
