<?php

namespace Framework;

use Closure;

class InjectionContainer
{
    private static $registry = array();

    public function register($name, Closure $resolve)
    {
        self::$registry[$name] = $resolve;
    }

    public static function resolve($name)
    {
        if (self::registered($name) )
        {
            $name = self::$registry[$name];
            return $name();
        }
        throw new \Exception("No class or method found. [InjectionContainer => resolve()]");
    }

    public static function registered($name)
    {
       return array_key_exists($name, self::$registry);
    }
}
