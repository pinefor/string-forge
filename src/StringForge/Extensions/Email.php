<?php
namespace StringForge\Extensions;
use StringForge\Extension;
use StringForge\StringForge;

class Email implements Extension
{
    public function filterEmail($string)
    {
        if ( preg_match(
            '~.*?\b([a-z0-9._%+=-]+@(?:[a-z0-9-]+\.)+[a-z]{2,6})\b.*~i',
            $string,
            $matches
        ) ) {
            return $matches[1];
        } else {
            return '';
        }
    }
}
