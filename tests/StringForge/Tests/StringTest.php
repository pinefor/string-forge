<?php
namespace StringForge\Tests;
use StringForge\StringForge;
use StringForge\String;

class StringTest extends  \PHPUnit_Framework_TestCase
{
    public function testCall()
    {
        $forge = new StringForge;
        $forge->add(new MockExtension);

        $string = new String($forge, 'string');
        $this->assertSame('string', (string) $string);
    }

    public function testMethodChaning()
    {
        $forge = new StringForge;
        $forge->add(new MockExtension);

        $string = new String($forge, 'string');
        $this->assertSame('STRING-one-two', (string) $string
            ->exampleFunction()
            ->exampleFunctionWithArgs('one', 'two')
        );
    }
}
