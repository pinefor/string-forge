<?php
namespace StringForge\Extension;

use StringForge\Extension;
use StringForge\StringForge;
use StringForge\FileReader;
use StringForge\Exception\UnsupportedLocaleException;

class StopWords implements Extension
{
    const RESOURCE_PATH = '/../../../resources/StopWords/';
    const TYPE_COMMON = 'Common';
    const TYPE_ADDRESS = 'Address';
    const TYPE_CITIES = 'Cities';

    private $words = [];
    private $fileReader;

    public function __constuct()
    {
        $this->fileReader = new FileReader();
    }

    public function filterCommonWords($string, $locale)
    {
        return $this->filter(self::TYPE_COMMON, $locale, $string);
    }

    public function filterAddressWords($string, $locale)
    {
        return $this->filter(self::TYPE_ADDRESS, $locale, $string);
    }

    public function filterCitiesWords($string, $locale)
    {
        return $this->filter(self::TYPE_CITIES, $locale, $string);
    }

    protected function filter($type, $locale, $string)
    {
        $this->lazyLoadStopWordsForLocale($type, $locale);

        $words = $this->words[$type][$locale];

        $regexp = [];
        array_walk($words, function ($word) use (&$regexp) {
            $regexp[] = sprintf('~\b%s\b~ui', preg_quote($word));
        });

        $string = preg_replace($regexp, '', $string);

        return $string;
    }

    protected function lazyLoadStopWordsForLocale($type, $locale)
    {
        if (isset($this->words[$type][$locale])) {
            return;
        }

        $this->loadStopWordsForLocale($type, $locale);
    }

    protected function loadStopWordsForLocale($type, $locale)
    {
        $file = $this->getResouceFile($type, $locale);
        if (!$file) {
            throw new UnsupportedLocaleException();
        }

        $this->words[$type][$locale] = $this->fileReader->read($file);
    }

    protected function getResouceFile($type, $locale)
    {
        $folder = __DIR__ . self::RESOURCE_PATH . $type . '/';

        $file = $folder . $locale;
        if (file_exists($file)) {
            return $file;
        }

        $localeParts = explode('_', $locale);
        $file = $folder . $localeParts[0] . '_ALL';
        if (file_exists($file)) {
            return $file;
        }

        return null;
    }
}
