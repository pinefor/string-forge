<?php
namespace StringForge\Tests;

use Mockery as m;
use StringForge\StringForge;

class StringForgeTest extends \PHPUnit_Framework_TestCase
{
    const EXAMPLE_LOCALE = 'en_US';
    const EXAMPLE_LOCALE_GB = 'en_GB';

    const EXAMPLE_STRING = 'qux';
    const EXAMPLE_METHOD = 'foo';
    const EXAMPLE_METHOD_WITH_LOCALE = 'bar';
    const EXAMPLE_METHOD_WITH_LOCALE_AND_ARGS = 'baz';
    const EXAMPLE_INVALID_METHOD = 'qux';
    const EXAMPLE_BUILTIN_METHOD = 'asciify';

    public function testConstructor()
    {
        $forge = new StringForge();
        $this->assertTrue($forge->hasMethod(self::EXAMPLE_BUILTIN_METHOD));

        $forge = new StringForge(false);
        $this->assertFalse($forge->hasMethod(self::EXAMPLE_BUILTIN_METHOD));

        $forge = new StringForge(true);
        $this->assertTrue($forge->hasMethod(self::EXAMPLE_BUILTIN_METHOD));
    }

    public function testAdd()
    {
        $forge = new StringForge;

        $this->assertFalse($forge->hasMethod(self::EXAMPLE_METHOD));

        $forge->add(new MockExtension);
        $this->assertTrue($forge->hasMethod(self::EXAMPLE_METHOD));
    }

    public function testExecute()
    {
        $forge = new StringForge;
        $forge->add(new MockExtension);
        $string = $forge->execute(
            self::EXAMPLE_METHOD,
            null,
            self::EXAMPLE_STRING,
            []
        );

        $this->assertSame('QUX', $string);
    }

    public function testExecuteWithLocale()
    {
        $forge = new StringForge;
        $forge->add(new MockExtension);

        $string = $forge->execute(
            self::EXAMPLE_METHOD_WITH_LOCALE,
            self::EXAMPLE_LOCALE,
            self::EXAMPLE_STRING,
            []
        );

        $this->assertSame('qux-en_US', $string);
    }

    public function testExecuteWithLocaleAndArgs()
    {
        $args = ['one', 'two'];
        $forge = new StringForge;
        $forge->add(new MockExtension);

        $string = $forge->execute(
            self::EXAMPLE_METHOD_WITH_LOCALE_AND_ARGS,
            self::EXAMPLE_LOCALE,
            self::EXAMPLE_STRING,
            $args
        );

        $this->assertSame('qux-en_US-one-two', $string);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExecuteNotValidFuncion()
    {
        $forge = new StringForge;
        $forge->add(new MockExtension);

        $string = $forge->execute(
            self::EXAMPLE_INVALID_METHOD,
            null,
            self::EXAMPLE_STRING,
            []
        );
    }

    public function testCreate()
    {
        $forge = new StringForge;
        $string = $forge->create('test', self::EXAMPLE_LOCALE);

        $this->assertInstanceOf('StringForge\String', $string);
        $this->assertSame('test', (string) $string);
        $this->assertSame(self::EXAMPLE_LOCALE, $string->getLocale());
    }

    public function testCreateWithDefaultLocale()
    {
        setlocale(LC_MESSAGES, self::EXAMPLE_LOCALE);

        $forge = new StringForge;
        $string = $forge->create('test');

        $this->assertInstanceOf('StringForge\String', $string);
        $this->assertSame('test', (string) $string);
        $this->assertSame(self::EXAMPLE_LOCALE, $string->getLocale());
    }
}
