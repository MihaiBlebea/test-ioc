<?php

namespace Framework\Alias;

use Framework\Alias\Facade;

class Car extends Facade
{
    public static function __callStatic($name, $arguments)
    {
        return parent::init( __CLASS__, $name, $arguments);
    }
}
