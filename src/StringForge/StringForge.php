<?php
namespace StringForge;

use ReflectionObject;
use ReflectionMethod;

class StringForge
{
    protected $locale;
    protected $methods = [];

    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    public function add(Extension $extension)
    {
        $methods = $this->getPublicMethodsFromExtension($extension);
        foreach ($methods as $method) {
            $this->registerMethod($extension, $method);
        }
    }

    protected function getPublicMethodsFromExtension(Extension $extension)
    {
        $reflection = new ReflectionObject($extension);

        return $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
    }

    protected function registerMethod(Extension $extension, ReflectionMethod $method)
    {
        $methodName = $method->name;

        if ( $this->hasMethod($methodName) ) {
            throw new \InvalidArgumentException(sprintf(
                'Another method with the name "%s" already exists.', 
                $methodName
            ));
        }

        $this->methods[$methodName] = [$extension, $methodName];
    }

    public function hasMethod($method)
    {
        return isset($this->methods[$method]);
    }

    public function execute($method, $string, $args)
    {
        if ( !$this->hasMethod($method) ) {
            throw new \InvalidArgumentException(sprintf(
                'Unknown method "%s".', $method));
        }

        return call_user_func_array(
            $this->methods[$method], 
            array_merge([$string], $args)
        );
    }

    public function create($string)
    {
        return new String($this, $string);
    }
}
