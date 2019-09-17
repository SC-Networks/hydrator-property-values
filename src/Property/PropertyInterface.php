<?php

namespace Scn\HydratorProperties\Property;

interface PropertyInterface
{
    public static function get(string $propertyName): \Closure;

    public static function set(string $propertyName): \Closure;
}
