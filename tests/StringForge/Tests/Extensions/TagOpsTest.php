<?php
namespace StringForge\Tests\Extensions;
use StringForge\Extensions\TagOps;
use StringForge\StringForge;
use StringForge\String;

class TagOpsTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->forge = new StringForge();
        $this->forge->add(new TagOps());
    }

    public function tearDown()
    {
        $this->forge = NULL;
    }

    public function testRemoveTagAttributes()
    {
        $string = new String($this->forge, '<body onload="Yu.init();"><div class="main">Foo</div></BODY>');
        $this->assertSame('<body><div>Foo</div></BODY>',
            (string) $string
                ->removeTagAttributes()
        );
    }

    public function testRemoveTags()
    {
        $string = new String($this->forge, '<customElement onload="Yu.init();"><div class="main">Foo</div><b>Bar</b><br/><br /></customElement>');
        $this->assertSame('<div class="main">Foo  Bar <br/><br />',
            (string) $string
                ->removeTags()
        );
    }
}
