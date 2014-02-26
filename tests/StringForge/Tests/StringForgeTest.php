<?php
namespace StringForge\Tests;
use StringForge\StringForge;

class StringForgeTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $forge = new StringForge;

        $this->assertFalse($forge->hasFunction('exampleFunction'));

        $forge->add(new MockExtension);
        $this->assertTrue($forge->hasFunction('exampleFunction'));
    }

    public function testExecute()
    {
        $forge = new StringForge;
        $forge->add(new MockExtension);

        $string = $forge->execute('exampleFunction', 'prueba', []);
        $this->assertSame('PRUEBA', $string);
    }

    public function testExecuteWithArgs()
    {
        $forge = new StringForge;
        $forge->add(new MockExtension);

        $string = $forge->execute('exampleFunctionWithArgs', 'prueba', ['one', 'two']);
        $this->assertSame('prueba-one-two', $string);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExecuteNotValidFuncion()
    {
        $forge = new StringForge;
        $forge->add(new MockExtension);

        $string = $forge->execute('notValidFuncion', 'prueba', []);
    }

    public function testCreate()
    {
        $forge = new StringForge;
        $this->assertInstanceOf('StringForge\String', $forge->create('test'));
        $this->assertSame('test', (string) $forge->create('test'));
    }
}
