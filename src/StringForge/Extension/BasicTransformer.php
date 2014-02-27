<?php
namespace StringForge\Extension;

use StringForge\Extension;
use StringForge\StringForge;

class BasicTransformer implements Extension
{
    public function ucfirst($string)
    {
        return ucfirst($string);
    }

    public function ucwords($string)
    {
        return ucwords($string);
    }

    public function trim($string)
    {
        return trim($string);
    }
    
    public function strtoupper($string)
    {
        return strtoupper($string);
    }  

    public function strtolower($string)
    {
        return strtolower($string);
    }

    public function replace($string, $search, $replace)
    {
        return str_replace($search, $replace, $string);
    }

    public function replaceCaseInsensitive($string, $search, $replace)
    {
        return str_ireplace($search, $replace, $string);
    }

    public function regexpReplace($string, $pattern, $replacement)
    {
        return preg_replace($pattern, $replacement, $string);
    }
}
