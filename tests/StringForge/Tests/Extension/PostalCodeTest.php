<?php
namespace StringForge\Tests\Extension;
use StringForge\Extension\PostalCode;
use StringForge\StringForge;
use StringForge\String;

class PostalCodeTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->extension = new PostalCode();
    }


    /**
     * @dataProvider provider
     */
    public function testAsciifySavingChars($locale, $string, $expected)
    {
        $this->assertSame($expected, $this->extension->filterPostalCode($string, $locale));
    }

    public function provider()
    {
        return [
            ['es_ES', 'foo 28016', '28016'],
            ['pt_PT', '15 foo street, Lisboa 1170', '1170'],
            ['it_IT', 'foo 01100', '01100'],
            ['en_GB', 'London YO1 7LX', 'YO1 7LX'],
            ['es_CL', 'foo 3660000', '3660000'],
            ['es_AR', 'foo C1002DEG', 'C1002DEG'],
        ];
    }

}
