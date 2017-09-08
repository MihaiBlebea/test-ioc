<?php

namespace Framework\Factory;

use Framework\Interfaces\FactoryInterface;
use Exception;
use Config;
use Framework\Injectables\Injector;

class EventFactory implements FactoryInterface
{
    private static $namespace;

    public static function init()
    {
        $config = Injector::resolve("Config");
        $config = $config->getConfig("application");
        static::$namespace = $config["event_namespace"];
    }

    public static function build($type = "", $path = "")
    {
        static::init();

        if($path == "")
        {
            $className = static::$namespace . ucfirst($type) . "Event";
        } else {
            $className = "Framework\\Events\\" . ucfirst($type) . "Event";
        }

        if($type == "")
        {
             throw new Exception('No type given');
        } else {
            if(class_exists($className))
            {
                return new $className();
            } else {
                throw new Exception($className . ' does not exist.');
            }
        }
    }
}
