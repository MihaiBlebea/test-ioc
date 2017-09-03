<?php

namespace Framework\Factory;

use Framework\Injectables\Injector;

class EmailFactory
{
    private static $namespace;

    public static function init()
    {
        $config = Injector::resolve("Config");
        $config = $config->getConfig("application");
        static::$namespace = $config["email_namespace"];
    }

    public static function build($email)
    {
        static::init();

        if($email == "")
        {
            throw new \Exception('No email found');
        } else {
            $className = static::$namespace . ucfirst($email);

            if(class_exists($className))
            {
                return new $className();
            } else {
                throw new \Exception('Email class not found.');
            }
        }
    }
}
