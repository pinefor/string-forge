<?php
namespace StringForge\Tests\Extension;

use StringForge\Extension\TagOps;
use StringForge\StringForge;
use StringForge\String;

class TagOpsTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->extension = new TagOps();
    }

    public function testRemoveTagAttributes()
    {
        $string = '<body onload="Yu.init();"><div class="main">Foo</div></BODY>';
        $expected = '<body><div>Foo</div></BODY>';

        $this->assertSame($expected, $this->extension->removeTagAttributes($string));
    }

    public function testRemoveTags()
    {
        $string = '<customElement onload="Yu.init();"><div class="main">Foo</div><b>Bar</b><br/><br /></customElement>';
        $expected = '<div class="main">Foo  Bar <br/><br />';

        $this->assertSame($expected, $this->extension->removeTags($string));
    }
}
