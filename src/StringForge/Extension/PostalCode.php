<?php
namespace StringForge\Extension;
use StringForge\Extension;
use StringForge\StringForge;
use StringForge\Exception\UnsupportedLocaleException;

class PostalCode implements Extension
{
    protected $regexps = [
        'en_GB' => '~ (\b (GIR\ 0AA) | (((A [BL] | B [ABDHLNRSTX]? | C [ABFHMORTVW] | D [ADEGHLNTY] | E [HNX]? | F [KY] | G [LUY]? | H [ADGPRSUX] | I [GMPV] | JE | K [ATWY] | L [ADELNSU]? | M [EKL]? | N [EGNPRW]? | O [LX] | P [AEHLOR] | R [GHM] | S [AEGKLMNOPRSTY]? | T [ADFNQRSW] | UB | W [ADFNRSV] | YO | ZE ) [1-9]? [0-9] | ((E|N|NW|SE|SW|W) 1 | EC [1-4] | WC [12] ) [A-HJKMNPR-Y] | (SW | W ) ([2-9] | [1-9] [0-9] ) | EC [1-9] [0-9] ) \ ? [0-9] [ABD-HJLNP-UW-Z]{2} ) \b ) ~x',
        'es_AR' => '~.*?\b([A-HJ-TP-Z][0-9]{4}[A-Z]{3})\b.*~',
        'es_CL' => '~.*?\b([0-9]{7})\b.*~',
        'es_ES' => '~.*?\b((?:5[0-2]|[0-4][0-9])[0-9]{3})\b.*~',
        'it_IT' => '~.*?\b([0-9]{5})\b.*~',
        'pt_PT' => '~.*?\b([0-9]{4})\b.*~',

    ];

    public function filterPostalCode($string, $locale)
    {
        $this->throwExceptionIfLocaleNotSupported($locale);

        if (preg_match($this->regexps[$locale], $string, $matches)) {
            return $matches[1];
        } else {
            return '';
        }
    }

    protected function throwExceptionIfLocaleNotSupported($locale)
    {
        if (isset($this->regexps[$locale])) {
            return;
        }

        throw new UnsupportedLocaleException();
    }
}

