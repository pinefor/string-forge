<?php
namespace StringForge\Tests\Extensions\it_IT;
use StringForge\Extensions\it_IT\PostalCode;
use StringForge\StringForge;
use StringForge\String;

class PostalCodeTest extends \PHPUnit_Framework_TestCase {

    private $forge;

    public function setUp() {
        $this->forge = new StringForge();
        $this->forge->add(new PostalCode());
    }

    public function tearDown() {
        $this->forge = NULL;
    }

    public function testFilterPostalCode() {
        $string = new String($this->forge, '15 blabla street, Roma 01100');
        $this->assertSame(
            '01100',
            (string)$string->filterPostalCode()
        );
    }

}

