<?php

namespace Scn\HydratorProperties\Property;

final class FloatValue implements PropertyInterface
{
    public static function get(string $propertyName): \Closure
    {
        return (new static())->createGetter($propertyName);
    }

    private function createGetter(string $propertyName): \Closure
    {
        return function () use ($propertyName): ?float {
            return $this->$propertyName;
        };
    }

    public static function set(string $propertyName): \Closure
    {
        return (new static())->createSetter($propertyName);
    }

    private function createSetter(string $propertyName): \Closure
    {
        return function ($value) use ($propertyName): void {
            $this->$propertyName = (float)$value;
        };
    }
}
