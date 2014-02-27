<?php
namespace StringForge\Tests\Extension;

use StringForge\Extension\BasicTransformer;
use StringForge\StringForge;
use StringForge\String;

class BasicTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->extension = new BasicTransformer();
    }

    public function testUcfirst()
    {
        $string = 'foo bar';
        $expected = 'Foo bar';

        $this->assertSame($expected, $this->extension->ucfirst($string));
    }

    public function testUcwords()
    {
        $string = 'foo bar';
        $expected = 'Foo Bar';

        $this->assertSame($expected, $this->extension->ucwords($string));
    }

    public function testTrim()
    {
        $string = '  bar';
        $expected = 'bar';

        $this->assertSame($expected, $this->extension->trim($string));
    }

    public function testStrtoupper()
    {
        $string = 'bar';
        $expected = 'BAR';

        $this->assertSame($expected, $this->extension->strtoupper($string));
    }

    public function testStrtolower()
    {
        $string = 'BAR';
        $expected = 'bar';

        $this->assertSame($expected, $this->extension->strtolower($string));
    }

    public function testReplace()
    {
        $string = 'BAR bar';
        $expected = 'BAR foo';

        $this->assertSame($expected, $this->extension->replace($string, 'bar', 'foo'));
    }

    public function testReplaceCaseInsensitive()
    {
        $string = 'BAR bar';
        $expected = 'foo foo';

        $this->assertSame($expected, $this->extension->replaceCaseInsensitive($string, 'bar', 'foo'));
    }

    public function testRegexpReplace()
    {
        $string = 'BAR bar';
        $expected = 'foo foo';

        $this->assertSame($expected, $this->extension->regexpReplace($string, '/bar/i', 'foo'));
    }
}
