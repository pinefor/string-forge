<?php
namespace StringForge\Tests\Extension;

use StringForge\Extension\Email;
use StringForge\StringForge;
use StringForge\String;

class EmailTest extends \PHPUnit_Framework_TestCase
{
    private $forge;

    public function setUp()
    {
        $this->extension = new Email();
    }

    public function testFilterEmailValid()
    {
        $string = 'foo bar @ my place philip+office@foo.com second-email@example.com';
        $expected = 'philip+office@foo.com';

        $this->assertSame($expected, $this->extension->filterEmail($string));
    }

    public function testFilterEmailInvalid()
    {
        $string = 'foo bar @ my place (no email whatsoever)';
        $expected = '';

        $this->assertSame($expected, $this->extension->filterEmail($string));

    }

    public function testFilterEmailBoth()
    {
        $string = 'foo bar @ my place philip+office@invalid+email.com second-email@example.com';
        $expected = 'second-email@example.com';

        $this->assertSame($expected, $this->extension->filterEmail($string));
    }
}
