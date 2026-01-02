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
class FirstAndLastKey
{
    public function __invoke(): Closure
    {
        return function (
            ?callable $first = null,
            mixed $firstDefault = null,
            ?callable $last = null,
            mixed $lastDefault = null,
        ): array {
            $all = $this->keys();

            return [$all->first($first, $firstDefault), $all->last($last, $lastDefault)];
        };
    }
}
