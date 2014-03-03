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

        $this->assertSame($expected, $this->extension->replace($string, null, 'bar', 'foo'));
    }

    public function testReplaceCaseInsensitive()
    {
        $string = 'BAR bar';
        $expected = 'foo foo';

        $this->assertSame($expected, $this->extension->replaceCaseInsensitive($string, null, 'bar', 'foo'));
    }

    public function testRegexpReplace()
    {
        $string = 'BAR bar';
        $expected = 'foo foo';

        $this->assertSame($expected, $this->extension->regexpReplace($string, null, '/bar/i', 'foo'));
    }

    public function testSortWords()
    {
        $string = 'foo bar';
        $expected = 'bar foo';

        $this->assertSame($expected, $this->extension->sortWords($string));
    }

    public function testUniqueWords()
    {
        $string = 'foo foo';
        $expected = 'foo';

        $this->assertSame($expected, $this->extension->uniqueWords($string));
    }

    public function testhtmlEntityEncode()
    {
        $string = 'foo € foo';
        $expected = 'foo &euro; foo';

        $this->assertSame($expected, $this->extension->htmlEntityEncode($string, null));
    }

    public function testhtmlEntityDecode()
    {
        $string = 'foo &euro; foo';
        $expected = 'foo € foo';

        $this->assertSame($expected, $this->extension->htmlEntityDecode($string));
    }
}
