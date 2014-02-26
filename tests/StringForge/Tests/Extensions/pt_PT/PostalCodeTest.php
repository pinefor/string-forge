<?php
namespace StringForge\Tests\Extensions\pt_PT;
use StringForge\Extensions\pt_PT\PostalCode;
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
        $string = new String($this->forge, '15 blabla street, Lisboa 1170');
        $this->assertSame(
            '1170',
            (string) $string->filterPostalCode()
        );
    }

}
