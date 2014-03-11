<?php
namespace StringForge;

use ReflectionObject;
use ReflectionMethod;
use InvalidArgumentException;
use StringForge\Extension;

class StringForge
{
    protected $methods = [];

    public function __construct($autoLoadBuiltInExtension = true)
    {
        if ($autoLoadBuiltInExtension) {
            $this->loadBuiltInExtension();
        }
    }

    protected function loadBuiltInExtension()
    {
        $this->add(new Extension\BasicTransformer());
        $this->add(new Extension\BasicFilter());
        $this->add(new Extension\StopWords());
        $this->add(new Extension\Asciify());
        $this->add(new Extension\Email());
        $this->add(new Extension\PostalCode());
        $this->add(new Extension\TagOps());
    }

    public function add(Extension $extension)
    {
        $methods = $this->getPublicMethodsFromExtension($extension);
        foreach ($methods as $method) {
            if ($method->name[0] == '_') {
                continue;
            }

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

        if ($this->hasMethod($methodName)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Another method with the name "%s" already exists.',
                    $methodName
                )
            );
        }

        $this->methods[$methodName] = [$extension, $methodName];
    }

    public function hasMethod($method)
    {
        return isset($this->methods[$method]);
    }

    public function execute($method, $locale, $string, $args)
    {
        if (!$this->hasMethod($method)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Unknown method "%s".',
                    $method
                )
            );
        }

        return call_user_func_array(
            $this->methods[$method],
            array_merge([$string, $locale], $args)
        );
    }

    public function create($string, $locale = null)
    {
        if (!$locale) {
            $locale = $this->getCurrentLocale();
        }

        $object = new String($this, $locale);
        $object->setValue($string);

        return $object;
    }

    private function getCurrentLocale()
    {
        $fullLocale = setlocale(LC_MESSAGES, "0");

        $locale = explode('.', $fullLocale);
        return $locale[0];
    }
}
