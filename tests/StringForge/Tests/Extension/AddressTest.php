<?php
namespace StringForge\Tests\Extension;

use StringForge\Extension\Address;
use StringForge\StringForge;
use StringForge\String;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->extension = new Address();
    }


    /**
     * @dataProvider provider
     */
    public function testAsciifySavingChars($locale, $string, $expected)
    {
        $this->assertSame($expected, $this->extension->filterAddress($string, $locale));
    }

    public function provider()
    {
        return [
            [
                'es_ES', 
                'cerro del castañar 44, planta 5º, entreplanta, 28034 Madrid', 
                'cerro del castañar 44,  5º, , 28034 Madrid'
            ],
        ];
    }

}
