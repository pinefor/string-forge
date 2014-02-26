<?php
namespace StringForge\Tests\Extensions\en_GB;
use StringForge\Extensions\en_GB\PostalCode;
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
        $string = new String($this->forge, '15 blabla street, London YO1 7LX');
        $this->assertSame(
            'YO1 7LX',
            (string) $string->filterPostalCode()
        );
    }

}
