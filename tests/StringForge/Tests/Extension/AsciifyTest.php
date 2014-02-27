<?php
namespace StringForge\Tests\Extension;

use StringForge\Extension\Asciify;
use StringForge\StringForge;
use StringForge\String;

class AsciifyTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->extension = new Asciify();
    }

    public function testAsciify()
    {
        $locales = [
            'es_ES', 'es_CL', 'es_AR', 'it_IT', 'pt_PT', 'pt_BR', 'en_GB'
        ];

        $string = '¡¿ÁaéEúüÜèóïçÇñÑ?!';
        $expected = 'AaeEuuUeoicCnN?!';

        foreach ($locales as $locale) {
            setlocale(LC_ALL, $locale);
            $this->assertSame($expected, $this->extension->asciify($string));
        }
    }

    public function testAsciifySavingChars()
    {
        $string = '¡¿ÁaéEúüÜèóïçÇñÑ?!';
        $expected = 'AaeEuuUeoiçÇñÑ?!';

        $this->assertSame($expected, $this->extension->asciify($string, ['ñ','Ñ','Ç','ç']));
    }

    public function testSlugifly()
    {
        $string = '¡ ¿ Á a é E ú ü Ü è ó ï ç Ç ñ Ñ ? ! ';
        $expected = 'a-e-u-u-e-o-i-c-n';

        $this->assertSame($expected, $this->extension->slugify($string));
    }

}
