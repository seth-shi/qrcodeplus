<?php

namespace DavidNineRoc\Qrcode;

use DavidNineRoc\Qrcode\Exception\InvalidException;

class Factory
{
    protected static $providers;

    public static function __callStatic($method, $parameters)
    {
        $instance = static::getInstance($method);

        return new $instance(...$parameters);
    }

    protected static function getInstance($abstract)
    {
        if (!static::hasInstance($abstract)) {
            throw new InvalidException('NOT TYPE FACTORY');
        }

        $providers = static::getProviders();

        return $providers[$abstract];
    }

    protected static function hasInstance($abstract)
    {
        return array_key_exists($abstract, static::getProviders());
    }

    protected static function getProviders()
    {
        if (is_null(static::$providers)) {
            static::$providers = require __DIR__.'/Providers.php';
        }

        return static::$providers;
    }
}
