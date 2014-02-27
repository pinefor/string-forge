<?php
namespace StringForge\Tests\Extension;

use StringForge\Extension\StopWords;
use StringForge\StringForge;
use StringForge\String;

class StopWordsTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->extension = new StopWords();
    }


    /**
     * @dataProvider addressProvider
     */
    public function testFilterAddressWords($locale, $string, $expected)
    {
        $this->assertSame($expected, $this->extension->filterAddressWords($string, $locale));
    }

    public function addressProvider()
    {
        return [
            [
                'es_ES', 
                'cerro del castañar 44, planta 5º, entreplanta, 28034 Madrid', 
                'cerro del castañar 44,  5º, , 28034 Madrid'
            ],
            [
                'es_ES', 
                'cerro del entreplantacastañar 44, planta 5º, entreplanta, 28034 Madrid', 
                'cerro del entreplantacastañar 44,  5º, , 28034 Madrid'
            ],
        ];
    }

    /**
     * @dataProvider commonProvider
     */
    public function testFilterCommonWords($locale, $string, $expected)
    {
        $this->assertSame($expected, $this->extension->filterCommonWords($string, $locale));
    }

    public function commonProvider()
    {
        return [
            [
                'es_ES', 
                'me paso una cosa muy mala', 
                'me paso  cosa  mala'
            ],
            [
                'en_GB', 
                'was a terrible night', 
                '  terrible night'
            ],
        ];
    }

    /**
     * @dataProvider citiesProvider
     */
    public function testFilterCitiesWords($locale, $string, $expected)
    {
        $this->assertSame($expected, $this->extension->filterCitiesWords($string, $locale));
    }

    public function citiesProvider()
    {
        return [
            [
                'es_ES', 
                'me voy a madrid',
                'me voy a '
            ],
            [
                'en_GB', 
                'born in london', 
                'born in '
            ],
        ];
    }
}
