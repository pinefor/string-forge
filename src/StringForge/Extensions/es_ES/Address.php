<?php
namespace StringForge\Extensions\es_ES;
use StringForge\Extension;
use StringForge\StringForge;

class Address implements Extension
{
    private $filterAddress = [
        'n', 'num', 'entlo', 'entlo.', 'entresuelo', 'entreplanta', 'bjs', 'depto',
        'zona', 'local', 'locales', 'edificio', 'escalera', 'planta', 'bloque',
        'portal', 'edf', 'derecha', 'izquierda', 'izq', 'izqa', 'izqo', 'izqdo',
        'izqda', 'der', 'dcha', 'oficina'
    ];

    public function register(StringForge $forge)
    {
        $forge->register( 'filterAddress', [$this, 'filterAddress'] );
    }

    public function filterAddress($string)
    {
        $string = preg_replace(
            '/' . implode( '|', array_map( 'preg_quote', $this->filterAddress ) ) . '/u',
            '',
            $string
        );

        return $string;
    }
}
