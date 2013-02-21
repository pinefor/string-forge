<?php
namespace StringForge\Extensions\en_GB;
use StringForge\Extension;
use StringForge\StringForge;

class PostalCode implements Extension {


    public function register(StringForge $forge) {
        $forge->register('filterPostalCode', [$this, 'filterPostalCode']);
    }

    public function filterPostalCode($string) {
        if ( preg_match(
            '~
                (
                    \b (GIR\ 0AA)
                    | (
                        (
                            (
                                A [BL]
                                | B [ABDHLNRSTX]?
                                | C [ABFHMORTVW]
                                | D [ADEGHLNTY]
                                | E [HNX]?
                                | F [KY]
                                | G [LUY]?
                                | H [ADGPRSUX]
                                | I [GMPV]
                                | JE
                                | K [ATWY]
                                | L [ADELNSU]?
                                | M [EKL]?
                                | N [EGNPRW]?
                                | O [LX]
                                | P [AEHLOR]
                                | R [GHM]
                                | S [AEGKLMNOPRSTY]?
                                | T [ADFNQRSW]
                                | UB
                                | W [ADFNRSV]
                                | YO
                                | ZE
                            ) [1-9]? [0-9]
                            | (
                                (E|N|NW|SE|SW|W) 1
                                | EC [1-4]
                                | WC [12]
                            ) [A-HJKMNPR-Y]
                            | (SW | W ) ([2-9] | [1-9] [0-9] )
                            | EC [1-9] [0-9]
                        )
                        \ ? [0-9] [ABD-HJLNP-UW-Z]{2}
                    ) \b
                )
            ~x',
            $string,
            $matches
        ) ) {
            return $matches[1];
        } else {
            return '';
        }
    }
}