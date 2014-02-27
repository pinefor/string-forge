<?php
namespace StringForge\Extension;

use StringForge\Extension;
use StringForge\StringForge;
use StringForge\Exception\UnsupportedLocaleException;


class Address implements Extension
{
    private $filterAddress = [
        'es_ES' =>  [
            'n', 'num', 'entlo', 'entlo.', 'entresuelo', 'entreplanta', 'bjs', 'depto',
            'zona', 'local', 'locales', 'edificio', 'escalera', 'planta', 'bloque',
            'portal', 'edf', 'derecha', 'izquierda', 'izq', 'izqa', 'izqo', 'izqdo',
            'izqda', 'der', 'dcha', 'oficina'
        ]
    ];

    public function filterAddress($string, $locale)
    {
        $this->throwExceptionIfLocaleNotSupported($locale);

        $words = $this->filterAddress[$locale];
        $regexp = '/' . implode('|', array_map('preg_quote', $words)) . '/u';

        $string = preg_replace($regexp, '', $string);

        return $string;
    }

    protected function throwExceptionIfLocaleNotSupported($locale)
    {
        if (isset($this->filterAddress[$locale])) {
            return;
        }

        throw new UnsupportedLocaleException();
    }
}
