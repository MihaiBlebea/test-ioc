<?php

namespace Framework\Factory;

use Framework\Interfaces\FactoryInterface;
use Exception;
use Framework\Injectables\Injector;

class SessionFactory implements FactoryInterface
{
    private static $namespace;

    public static function init()
    {
        $config = Injector::resolve("Config");
        $config = $config->getConfig("application");
        static::$namespace = $config["session_namespace"];
    }

    public static function build($type = "", $path = "")
    {
        static::init();

        if($path == "")
        {
            $className = static::$namespace . ucfirst($type) . "Session";
        } else {
            $className = "Framework\\Sessions\\" . ucfirst($type) . "Session";
        }

        if($type == "")
        {
            throw new Exception('No session type supplied');
        } else {
            if(class_exists($className))
            {
                return new $className();
            } else {
                throw new Exception($className . "class not found.");
            }
        }
    }
}
