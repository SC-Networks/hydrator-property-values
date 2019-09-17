<?php

namespace Scn\HydratorProperties\Property;

use Scn\HydratorProperties\Config\HydratorConfigInterface;
use Scn\Hydrator\Hydrator;

class ObjectValue implements PropertyObjectInterface
{
    public static function get(string $propertyName): \Closure
    {
        return (new static())->createGetter($propertyName);
    }

    private function createGetter(string $propertyName): \Closure
    {
        return function () use ($propertyName): ?object {
            return $this->$propertyName;
        };
    }

    public static function set(string $propertyName, HydratorConfigInterface $hydratorConfig = null): \Closure
    {
        return (new static())->createSetter($propertyName, $hydratorConfig);
    }

    private function createSetter(string $propertyName, HydratorConfigInterface $hydratorConfig = null): \Closure
    {
        return function ($value) use ($propertyName, $hydratorConfig): void {
            if ($hydratorConfig instanceof HydratorConfigInterface) {
                $hydrator = new Hydrator();

                $object = $hydratorConfig->getObject();

                $hydrator->hydrate(
                    $hydratorConfig,
                    $object,
                    (array)$value
                );

                $this->$propertyName = $object;
            }
        };
    }
}
