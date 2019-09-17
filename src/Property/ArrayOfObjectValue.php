<?php

namespace Scn\HydratorProperties\Property;

use Scn\HydratorProperties\Config\HydratorConfigInterface;
use Scn\Hydrator\Hydrator;

class ArrayOfObjectValue implements PropertyObjectInterface
{
    public static function get(string $propertyName): \Closure
    {
        return (new static())->createGetter($propertyName);
    }

    private function createGetter(string $propertyName): \Closure
    {
        return function () use ($propertyName): ?array {
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
            $items = [];

            if (isset($value->item)) {
                if (!is_array($value->item)) {
                    $items = [$value->item];
                } else {
                    $items = $value->item;
                }
            } elseif (is_array($value)) {
                $items = $value;
            }

            if ($hydratorConfig instanceof HydratorConfigInterface) {
                $hydrator = new Hydrator();

                foreach ($items as $key => $item) {
                    $object = $hydratorConfig->getObject();

                    $hydrator->hydrate(
                        $hydratorConfig,
                        $object,
                        (array)$item
                    );

                    $items[$key] = $object;
                }
            }

            $this->$propertyName = (array)$items;
        };
    }
}
