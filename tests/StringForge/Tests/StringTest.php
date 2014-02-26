<?php
namespace StringForge\Tests;

use StringForge\String;
use Mockery as m;

class StringTest extends  \PHPUnit_Framework_TestCase
{
    const EXAMPLE_LOCALE = 'en_US';
    const EXAMPLE_STRING = 'foo';

    public function testSetValue()
    {
        $forge = m::mock('StringForge\StringForge');

        $string = new String($forge);
        $string->setValue(self::EXAMPLE_STRING);

        $this->assertSame(self::EXAMPLE_STRING, (string) $string);
    }

    public function testMagicCall()
    {
        $args = ['foo', 'bar'];

        $forge = m::mock('StringForge\StringForge');
        $forge
            ->shouldReceive('execute')
            ->with('bar', self::EXAMPLE_LOCALE, self::EXAMPLE_STRING, $args)
            ->once();

        $string = new String($forge, self::EXAMPLE_LOCALE);
        $string->setValue(self::EXAMPLE_STRING);

        $this->assertSame($string, $string->bar($args[0], $args[1]));
    }

}
