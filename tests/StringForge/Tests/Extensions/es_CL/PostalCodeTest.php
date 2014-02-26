<?php
namespace StringForge\Tests\Extensions\es_CL;
use StringForge\Extensions\es_CL\PostalCode;
use StringForge\StringForge;
use StringForge\String;

class PostalCodeTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->forge = new StringForge();
        $this->forge->add(new PostalCode());
    }

    public function tearDown()
    {
        $this->forge = NULL;
    }

    public function testFilterPostalCode()
    {
        $string = new String($this->forge, '15 blabla street, san javier, 3660000');
        $this->assertSame(
            '3660000',
            (string) $string->filterPostalCode()

        );
    }

}
