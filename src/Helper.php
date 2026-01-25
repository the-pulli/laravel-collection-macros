<?php

namespace Pulli\LaravelCollectionMacros;

use Countable;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Helper utilities for collection macros
 */
class Helper
{
    /**
     * Check if the given object can be converted to an array
     *
     * @param  mixed  $object  The object to check
     * @return bool True if the object implements Arrayable or has a toArray() method
     */
    public static function isArrayable(mixed $object): bool
    {
        return $object instanceof Arrayable || (is_object($object) && method_exists($object, 'toArray'));
    }

    /**
     * Get the count of a value (array, Countable, or object with count method)
     *
     * @param  mixed  $value  The value to count
     * @return int The count, or 0 if the value is not countable
     */
    public static function count(mixed $value): int
    {
        if (is_array($value)) {
            return count($value);
        }

        if ($value instanceof Countable || (is_object($value) && method_exists($value, 'count'))) {
            return $value->count();
        }

        return 0;
    }
}
