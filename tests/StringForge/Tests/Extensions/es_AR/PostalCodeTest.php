<?php
namespace StringForge\Tests\Extensions\es_AR;
use StringForge\Extensions\es_AR\PostalCode;
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
        $string = new String($this->forge, '15 blabla street, buenos aires C1002DEG');
        $this->assertSame(
            'C1002DEG',
            (string) $string->filterPostalCode()

        );
    }

}
