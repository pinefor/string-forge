<?php
namespace StringForge\Tests\Extension;

use StringForge\Extension\BasicFilter;
use StringForge\StringForge;
use StringForge\String;

class BasicFilterTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->extension = new BasicFilter();
    }

    public function testRemoveNum()
    {
        $string = 'as3i23 4jh523.';
        $expected = 'asi jh.';

        $this->assertSame($expected, $this->extension->removeNum($string));
    }

    public function testRemoveAlpha()
    {
        $string = 'as3i23 4jh523.';
        $expected = '323 4523.';

        $this->assertSame($expected, $this->extension->removeAlpha($string));
    }

    public function testOnlyNum()
    {
        $string = 'as3i23 4jh523.';
        $expected = '3234523';

        $this->assertSame($expected, $this->extension->onlyNum($string));
    }

    public function testOnlyAlpha()
    {
        $string = 'as3i23 4jh523.';
        $expected = 'asijh';

        $this->assertSame($expected, $this->extension->onlyAlpha($string));
    }

    public function testOnlyAlphaNum()
    {
        $string = 'as3i23 4jh523.';
        $expected = 'as3i234jh523';

        $this->assertSame($expected, $this->extension->onlyAlphaNum($string));
    }

    public function testOnlyAlphaNumWithSpaces()
    {
        $string = 'as3i23 4jh523.';
        $expected = 'as3i23 4jh523';

        $this->assertSame($expected, $this->extension->onlyAlphaNum($string, false));
    }

    public function testRemoveChars()
    {
        $string = 'I, love ice-cream [indeed].';
        $expected = 'I love icecream indeed';

        $this->assertSame($expected, $this->extension->removeChars($string, ['.',',','-','[',']']));
    }

    public function testRemoveParentheses()
    {
        $string = 'I (John Doe), love ice-cream [indeed].';
        $expected = 'I , love ice-cream [indeed].';

        $this->assertSame($expected, $this->extension->removeParentheses($string));
    }

    public function testReduceSpaces()
    {
        $string = 'I  love        icecream   . ';
        $expected = 'I love icecream . ';

        $this->assertSame($expected, $this->extension->reduceSpaces($string));
    }

    public function testSentenceSpacing()
    {
        $string = 'Doctor  ,I  love        icecream(at all) .[But I do hate pudding... ] ';
        $expected = 'Doctor, I love icecream (at all). [But I do hate pudding...]';

        $this->assertSame($expected, $this->extension->sentenceSpacing($string));
    }

}
