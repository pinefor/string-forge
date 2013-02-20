<?php
namespace StringForge\Tests\Extensions\es_ES;
use StringForge\Extensions\es_ES\Address;
use StringForge\StringForge;
use StringForge\String;

class AddressTest extends \PHPUnit_Framework_TestCase {

    private $forge;

    public function setUp() {
        $this->forge = new StringForge();
        $this->forge->add(new Address());
    }

    public function tearDown() {
        $this->forge = NULL;
    }

    public function testFilterAddress() {
        $string = new String($this->forge, 'cerro del castañar 44, planta 5º, entreplanta, 28034 Madrid');
        $this->assertSame(
            'cerro del castañar 44,  5º, , 28034 Madrid',
            (string)$string->filterAddress()

        );
    }

}

