<?php
namespace StringForge;

class Ejemplo implements Extension {
    public function register(StringForge $forge) {
        $forge->register('cleanAcutes', [$this, 'cleanAcutes']);
    }

    public function cleanAcutes($string) {
        return strtoupper($string);
    }
}