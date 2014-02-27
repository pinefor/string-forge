<?php
namespace StringForge\Extension;

use StringForge\Extension;
use StringForge\StringForge;

class BasicFilter implements Extension
{
    public function removeNum($string)
    {
        $string = preg_replace('~[0-9]~', '', $string);

        return $string;
    }

    public function removeAlpha($string, $caseSens = false)
    {
        $string = preg_replace('~[a-z]~' . ($caseSens ? '' : 'i'), '', $string);

        return $string;
    }

    public function onlyNum($string)
    {
        $string = preg_replace('~[^0-9]~', '', $string );

        return $string;
    }

    public function onlyAlpha($string, $caseSens = false)
    {
        $string = preg_replace('~[^a-z]~' . ($caseSens ? '' : 'i'), '', $string);

        return $string;
    }

    public function onlyAlphaNum($string, $removeSpaces = true )
    {
        $string = preg_replace(
            '/[^a-z0-9' . ( $removeSpaces ? '' : '\s' ) . ']/i',
            '',
            $string
        );

        return $string;
    }

    public function removeChars($string, $chars)
    {
        $string = preg_replace(
            '/' . implode( '|', array_map( 'preg_quote', $chars ) ) . '/u',
            '',
            $string
        );

        return $string;
    }

    public function removeParentheses($string)
    {
        return preg_replace('~\(.*?\)~', '', $string);
    }

    public function reduceSpaces($string)
    {
        $string = preg_replace('~ {2,}~',' ',$string);

        return $string;
    }

    public function sentenceSpacing($string)
    {
        $string = $this->reduceSpaces($string);

        $string = preg_replace(
            '~([a-z0-9])([[{(])~', // Put space betw. string and opening.
            '$1 $2',
            $string
        );

        $string = preg_replace(
            '~([.:;,)\]}])(?!\s|[0-9.:;,)\]}])~', // Put space after stop.
            '$1 ',
            $string
        );

        $string = preg_replace(
            [
                '~([a-z0-9]) ([)\]}.,:;])~i', // Remove space betw string and stop.
                '~([.,:;]) ([)\]}])~',        // Remove space betw stops.
                '~([)\]}]) ([.,:;])~',        // (idem)
            ],
            '$1$2',
            $string
        );

        return trim($string);
    }
}
