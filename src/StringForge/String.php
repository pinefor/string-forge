<?php
namespace StringForge;

class String
{
    private $string;
    private $forge;

    public function __construct(StringForge $forge, $locale = null)
    {
        $this->forge = $forge;
        $this->locale = $locale;
    }

    public function setValue($string)
    {
        $this->string = $string;
    }

    public function __call($function, array $args)
    {
        $this->string = $this->forge->execute(
            $function, 
            $this->locale, 
            $this->string, 
            $args
        );

        return $this;
    }

    public function __toString()
    {
        return (string) $this->string;
    }
}
