<?php
namespace StringForge\Tests\Extensions;
use StringForge\Extensions\Email;
use StringForge\StringForge;
use StringForge\String;

class EmailTest extends \PHPUnit_Framework_TestCase {

    private $forge;

    public function setUp() {
        $this->forge = new StringForge();
        $this->forge->add(new Email());
    }

    public function tearDown() {
        $this->forge = NULL;
    }

    public function testFilterEmail() {
        $string = new String($this->forge, 'foo bar @ my place philip+office@yunait.com second-email@example.com');
        $this->assertSame('philip+office@yunait.com',
            (string)$string
                ->filterEmail()
        );

        $string = new String($this->forge, 'foo bar @ my place philip+office@invalid+email.com second-email@example.com');
        $this->assertSame('second-email@example.com',
            (string)$string
                ->filterEmail()
        );

        $string = new String($this->forge, 'foo bar @ my place (no email whatsoever)');
        $this->assertSame('',
            (string)$string
                ->filterEmail()
        );
    }
}

