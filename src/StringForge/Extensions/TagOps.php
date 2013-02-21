<?php
namespace StringForge\Extensions;
use StringForge\Extension;
use StringForge\StringForge;

class TagOps implements Extension {

    public function register(StringForge $forge) {
        $forge->register('removeTagAttributes', [$this, 'removeTagAttributes']);
        $forge->register('removeTags', [$this, 'removeTags']);
    }

    public function removeTagAttributes($string) {
        return preg_replace('~<([a-z][a-z0-9]*)[^>]*?(/?)>~i','<$1$2>', $string);
    }

    public function removeTags($string) {
        $validTags = [
            'p',
            'span',
            'div',
            'br'
        ];
        return trim(
            preg_replace(
                '~<(/?)(?!' . implode('|',$validTags) . ').*?\s?.*?/?>~i',
                ' ',
                $string
            )
        );
    }

    public function removeLinks($string) {
        return preg_replace('~</?a\b.*?>~i', '', $string);
    }
}
