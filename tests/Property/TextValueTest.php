<?php

namespace Scn\HydratorProperties\Property;

use Scn\HydratorProperties\TestCase;

class TextValueTest extends TestCase
{
    public function testEverything()
    {
        $testValue = substr(str_shuffle(str_repeat(
            $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil(10 / strlen($x))
        )), 1, 10);
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

        $set = TextValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = TextValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsString($dummy->getValue());
        static::assertSame($testValue, $dummy->getValue());
        static::assertSame($testValue, $get('value'));
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

        $set = TextValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = TextValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsString($dummy->getValue());
        static::assertSame('' . $testValue, $dummy->getValue());
        static::assertSame('' . $testValue, $get('value'));
    }
}
