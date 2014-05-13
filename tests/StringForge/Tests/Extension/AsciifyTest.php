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
            $this->assertSame($expected, $this->extension->asciify($string, null));
        }
    }

    public function testAsciifySavingChars()
    {
        $string = '¡¿ÁaéEúüÜèóïçÇñÑ?!';
        $expected = 'AaeEuuUeoiçÇñÑ?!';

        $this->assertSame($expected, $this->extension->asciify($string, null, ['ñ','Ñ','Ç','ç']));
    }

    public function testSlugifly()
    {
        $string = '¡ ¿ Á a é E ú ü Ü è ó ï ç Ç ñ Ñ ? ! ';
        $expected = 'a-a-e-e-u-u-u-e-o-i-c-c-n-n';

        $this->assertSame($expected, $this->extension->slugify($string, null));
    }

    public function testSlugiflyDoubleSpace()
    {
        $string = '¡ ¿ a  b';
        $expected = 'a--b';

        $this->assertSame($expected, $this->extension->slugify($string, null));
    }

    public function testSlugiflyUpercase()
    {
        $string = '¡ ¿ A  B';
        $expected = 'a--b';

        $this->assertSame($expected, $this->extension->slugify($string, null));
    }
}
