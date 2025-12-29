<?php

use Illuminate\Support\Stringable;
use Pulli\LaravelCollectionMacros\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function checkStringableExpectations($actual, string $expected): void
{
    expect($actual)->toBeInstanceOf(Stringable::class)
        ->and($actual->append(' are awesome!')->toString())->toBe($expected);
}
