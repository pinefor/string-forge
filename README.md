String-Forge 
==============================

A trunk full of useful string manipulation functions

Requirements
------------

* PHP 5.4.x
* neitanod/forceutf8

Installation
------------

The recommended way to install StringForge is [through composer](http://getcomposer.org).
You can see [the package information on Packagist.](https://packagist.org/packages/mcuadros/silex-newrelic)

```JSON
{
    "require": {
        "yunait/string-forge": "dev-master"
    }
}
```

Example
------------

```php
use StringForge\StringForge;

$forge = new StringForge();
$stringObj = $forge->create('¡¿ÁaéE323úüÜèóïç232ÇñÑ?!');
echo (string) $stringObj->asciify()->removeNum();
//Returns: AaeEuuUeoicCnN?!
```

Tests
-----

Tests are in the `tests` folder.
To run them, you need PHPUnit.
Example:

    $ phpunit --configuration phpunit.xml.dist


License
-------

MIT, see [LICENSE](LICENSE)
