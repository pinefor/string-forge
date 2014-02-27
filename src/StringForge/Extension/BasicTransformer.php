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

    public function replace($string, $locale, $search, $replace)
    {
        return str_replace($search, $replace, $string);
    }

    public function replaceCaseInsensitive($string, $locale, $search, $replace)
    {
        return str_ireplace($search, $replace, $string);
    }

    public function regexpReplace($string, $locale, $pattern, $replacement)
    {
        return preg_replace($pattern, $replacement, $string);
    }

    public function sortWords($string)
    {
        $words = explode(' ', $string);
        sort($words, SORT_NATURAL);

        return implode(' ', $words);
    }

    public function uniqueWords($string)
    {
        $words = explode(' ', $string);
        $words = array_unique($words);

        return implode(' ', $words);
    }

    public function htmlEntityEncode($string, $locale, $flags = ENT_HTML5, $encoding = 'UTF-8')
    {
        return htmlentities($string, $flags, $encoding);
    }

    public function htmlEntityDecode($string)
    {
        return html_entity_decode($string);
    }
}
