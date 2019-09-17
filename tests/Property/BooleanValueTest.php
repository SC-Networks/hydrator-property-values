<?php

namespace Scn\HydratorProperties\Property;

use Scn\HydratorProperties\TestCase;

class BooleanValueTest extends TestCase
{
    public function testEverythingFalse()
    {
        $testValue = false;
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

        $set = BooleanValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = BooleanValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsBool($dummy->getValue());
        static::assertSame($testValue, $dummy->getValue());
        static::assertFalse($get('value'));
    }

    public function testEverythingTrue()
    {
        $testValue = true;
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

        $set = BooleanValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = BooleanValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsBool($dummy->getValue());
        static::assertSame($testValue, $dummy->getValue());
        static::assertTrue($get('value'));
    }
}
