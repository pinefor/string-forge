<?php
namespace StringForge\Tests\Extensions\es_ES;
use StringForge\Extensions\es_ES\PostalCode;
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
        $string = new String($this->forge, 'cerro del castañar 44, planta 5º, entreplanta, 28034 Madrid, tel 91 321 23 24, también 28035 Madrid');
        $this->assertSame(
            '28034',
            (string)$string->filterPostalCode()

        );
        $string = new String($this->forge, 'cerro del castañar 44, planta 5º, entreplanta Madrid, tel 91 321 23 24');
        $this->assertSame(
            '',
            (string)$string->filterPostalCode()

        );
    }

}

