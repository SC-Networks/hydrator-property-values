<?php

namespace Scn\HydratorProperties\Property;

use Scn\HydratorProperties\Config\HydratorConfigInterface;

interface PropertyObjectInterface
{
    public static function get(string $propertyName): \Closure;

    public static function set(string $propertyName, HydratorConfigInterface $hydratorConfig = null): \Closure;
}
