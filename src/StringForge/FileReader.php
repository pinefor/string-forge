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

    public function read($file)
    {
        return $this->readFileLinesToArrayElements($file);
    }

    public function readJSONFile($file)
    {
        $dealJson = file_get_contents($file);
        return json_decode($dealJson, true);
    }

    private function readFileLinesToArrayElements($file)
    {
        $array = [];
        foreach (file($file) as $word) {
            $word = trim($word);
            if ($word === '') {
                continue;
            }
            $array[] = $word;

            $wordASCII = $this->asciify->asciify($word);
            if ($word != $wordASCII) {
                $array[] = $wordASCII;
            }
        }

        return $array;
    }
}
