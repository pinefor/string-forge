<?php

namespace StringForge;

use StringForge\Extension\Asciify;

class FileReader
{
    private $asciify;

    public function __construct()
    {
        $this->asciify = new Asciify();
    }

    public function readFile($file)
    {
        return $this->readFileLinesToArrayElements($file);
    }

    private function readFileLinesToArrayElements($file)
    {
        $array = [];
        foreach (file($file) as $word) {
            $word = trim($word);
            if ($word != '') {
                $array[] = $word;

                $wordASCII = $this->asciify->asciify($word);
                if ($word != $wordASCII) {
                    $array[] = $wordASCII;
                }
            }
        }

        return $array;
    }
}
