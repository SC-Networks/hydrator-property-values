<?php

namespace Scn\HydratorPropertyValues\Property;

final class BooleanValue implements PropertyInterface
{
    public static function get(string $propertyName): \Closure
    {
        return (new static())->createGetter($propertyName);
    }

    private function createGetter(string $propertyName): \Closure
    {
        return function () use ($propertyName): ?bool {
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
            $this->$propertyName = (bool)$value;
        };
    }
}
