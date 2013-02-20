<?php
namespace StringForge\Extensions\es_ES;
use StringForge\Extension;
use StringForge\StringForge;

class PostalCode implements Extension {


    public function register(StringForge $forge) {
        $forge->register('filterPostalCode', [$this, 'filterPostalCode']);
    }

    public function filterPostalCode($string) {
        if ( preg_match(
            '~.*?\b((?:5[0-2]|[0-4][0-9])[0-9]{3})\b.*~',
            $string,
            $matches
        ) ) {
            return $matches[1];
        } else {
            return '';
        }
    }
}
