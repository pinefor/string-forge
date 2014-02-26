<?php
namespace StringForge\Extensions\es_CL;
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
            '~.*?\b([0-9]{7})\b.*~',
            $string,
            $matches
        ) ) {
            return $matches[1];
        } else {
            return '';
        }
    }
}
