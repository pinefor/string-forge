<?php
namespace StringForge\Tests\Extensions;
use StringForge\Extensions\BasicOps;
use StringForge\StringForge;
use StringForge\String;

class BasicOpsTest extends \PHPUnit_Framework_TestCase {

    private $forge;

    public function setUp() {
        $this->forge = new StringForge();
        $this->forge->add(new BasicOps());
    }

    public function tearDown() {
        $this->forge = NULL;
    }

    public function testAsciify() {
        $string = new String($this->forge, '¡¿ÁaéEúüÜèóïçÇñÑ?!');
        $this->assertSame('AaeEuuUeoicCnN?!',
            (string)$string
                ->asciify()
        );
    }

    public function testAsciifySavingChars() {
        $string = new String($this->forge, '¡¿ÁaéEúüÜèóïçÇñÑ?!');
        $this->assertSame('AaeEuuUeoiçÇñÑ?!',
            (string)$string
                ->asciify(['ñ','Ñ','Ç','ç'])
        );
    }

    public function testRemoveNum() {
        $string = new String($this->forge, 'as3i23 4jh523.');
        $this->assertSame('asi jh.',
            (string)$string
                ->removeNum()
        );
    }

    public function testRemoveAlpha() {
        $string = new String($this->forge, 'as3i23 4jh523.');
        $this->assertSame('323 4523.',
            (string)$string
                ->removeAlpha()
        );
    }

    public function testOnlyNum() {
        $string = new String($this->forge, 'as3i23 4jh523.');
        $this->assertSame('3234523',
            (string)$string
                ->onlyNum()
        );
    }

    public function testOnlyAlpha() {
        $string = new String($this->forge, 'as3i23 4jh523.');
        $this->assertSame('asijh',
            (string)$string
                ->onlyAlpha()
        );
    }

    public function testOnlyAlphaNum() {
        $string = new String($this->forge, 'as3i23 4jh523.');
        $this->assertSame('as3i234jh523',
            (string)$string
                ->onlyAlphaNum()
        );

        $string = new String($this->forge, 'as3i23 4jh523.');
        $this->assertSame('as3i23 4jh523',
            (string)$string
                ->onlyAlphaNum(false)
        );
    }

    public function testRemoveChars() {
        $string = new String($this->forge, 'I, love ice-cream [indeed].');
        $this->assertSame('I love icecream indeed',
            (string)$string
                ->removeChars(['.',',','-','[',']'])
        );
    }

    public function testRemoveParentheses() {
        $string = new String($this->forge, 'I (John Doe), love ice-cream [indeed].');
        $this->assertSame('I , love ice-cream [indeed].',
            (string)$string
                ->removeParentheses()
        );
    }

    public function testReduceSpaces() {
        $string = new String($this->forge, 'I  love        icecream   . ');
        $this->assertSame('I love icecream . ',
            (string)$string
                ->reduceSpaces()
        );
    }

    public function testSentenceSpacing() {
        $string = new String($this->forge, 'Doctor  ,I  love        icecream(at all) .[But I do hate pudding... ] ');
        $this->assertSame('Doctor, I love icecream (at all). [But I do hate pudding...]',
            (string)$string
                ->sentenceSpacing()
        );
    }

}

