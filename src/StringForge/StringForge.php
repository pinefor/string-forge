<?php
namespace StringForge;

class StringForge {
    private $functions = [];

    public function add(Extension $extension) {
        $extension->register($this);
        return true;
    }

    public function register($function, array $callback) {
      if ( !is_string($function) || strlen($function) == 0 ) {
            throw new \InvalidArgumentException(sprintf('Invalid $function "%s" given', $function));
        }

        if ( !is_callable($callback) ) {
            throw new \InvalidArgumentException('Invalid $callback given');
        }

        if ( $this->hasFunction($function) ) {
            throw new \InvalidArgumentException(sprintf('Another function with the name "%s" already exists.', $function));
        }

        $this->functions[$function] = $callback;
    }

    public function hasFunction($function) {
        return isset($this->functions[$function]);
    }

    public function execute($function, $string, $args) {
        if ( !$this->hasFunction($function) ) {
            throw new \InvalidArgumentException(sprintf('unknown function "%s".', $function));
        }

        return call_user_func_array($this->functions[$function], array_merge([$string], $args));
    }

    public function create($string) {
        return new String($this, $string);
    }
}
