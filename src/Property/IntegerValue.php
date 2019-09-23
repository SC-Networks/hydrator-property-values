<?php

namespace Scn\HydratorPropertyValues\Property;

final class IntegerValue implements PropertyInterface
{
    public static function get(string $propertyName): \Closure
    {
        return (new static())->createGetter($propertyName);
    }

    private function createGetter(string $propertyName): \Closure
    {
        return function () use ($propertyName): ?int {
            return (int)$this->$propertyName;
        };
    }

    public static function set(string $propertyName): \Closure
    {
        return (new static())->createSetter($propertyName);
    }

    private function createSetter(string $propertyName): \Closure
    {
        return function ($value) use ($propertyName): void {
            $this->$propertyName = (int)$value;
        };
    }
}
