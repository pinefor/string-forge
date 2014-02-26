<?php
namespace StringForge\Extensions\es_AR;
use StringForge\Extension;
use StringForge\StringForge;

class PostalCode implements Extension
{
    public function register(StringForge $forge)
    {
        $forge->register('filterPostalCode', [$this, 'filterPostalCode']);
    }

    public function filterPostalCode($string)
    {
        if ( preg_match(
            '~.*?\b([A-HJ-TP-Z][0-9]{4}[A-Z]{3})\b.*~',
            $string,
            $matches
        ) ) {
            return $matches[1];
        } else {
            return '';
        }
    }
}
