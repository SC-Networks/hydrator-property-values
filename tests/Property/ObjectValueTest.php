<?php

namespace Scn\HydratorProperties\Property;

use Scn\HydratorProperties\Config\HydratorConfigInterface;
use Scn\HydratorProperties\TestCase;

class ObjectValueTest extends TestCase
{
    public function testEverything()
    {
        $testValue = new \stdClass();
        $testValue->item = [
            'some thing' => 'fine'
        ];

        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertNull($dummy->getValue());
        static::assertNull($get('value'));
    }

    public function testEverythingIfItemNotArray()
    {
        $testValue = new \stdClass();
        $testValue->item = 'fine';

        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertNull($dummy->getValue());
        static::assertNull($get('value'));
    }


    public function testEverythingInvalidInputType()
    {
        $testValue = mt_rand(1, PHP_INT_MAX);
        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertNull($dummy->getValue());
        static::assertNull($get('value'));
    }

    public function testContainsHydratedObjectsIfValueIsArray()
    {
        $testValue = new \stdClass();
        $testValue->description = 'some thing';
        $testValue->count = 456;

        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $config = new class implements HydratorConfigInterface {
            public function getObject(): object
            {
                return new class {
                };
            }

            public function getHydratorProperties(): array
            {
                return [
                    'description' => function () {
                        return 'test';
                    },
                    'count' => function () {
                        return 123;
                    }
                ];
            }

            public function getExtractorProperties(): array
            {
                return [];
            }
        };

        $set = ObjectValue::set('value', $config);
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
    }
}
