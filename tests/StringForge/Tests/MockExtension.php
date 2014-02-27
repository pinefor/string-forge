<?php
namespace StringForge\Tests;

use StringForge\Extension;
use StringForge\StringForge;

class MockExtension implements Extension
{
    // Plain
    public function foo($string)
    {
        return strtoupper($string);
    }

    // With locale
    public function bar($string, $locale)
    {
        return implode('-', func_get_args());
    }

    // With locale and args
    public function baz($string, $locale, $one, $two)
    {
        return implode('-', func_get_args());
    }
}
