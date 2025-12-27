<?php

namespace Pulli\LaravelCollectionMacros;

class IsArrayable
{
    public static function check(mixed $object): bool
    {
        return is_object($object) && method_exists($object, 'toArray');
    }
}
