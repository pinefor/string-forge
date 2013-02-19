<?php
namespace StringForge;

class String {
    private $string;
    private $forge;

    public function __construct(StringForge $forge, $string) {
        $this->forge = $forge;
        $this->string = $string;
    }

    public function __call($function, $args) {
        $this->string = $this->forge->execute($function, $this->string, $args);
        return $this;
    }

    public function __toString() {
        return $this->string;
    }
}