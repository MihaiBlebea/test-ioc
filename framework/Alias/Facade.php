<?php

namespace Framework\Alias;

use App\App;

class Facade
{
    /**
     * Store the namespace received from called Facade.
     */
    private static $namespace;

    /**
     * Store the name of the method called staticly.
     */
    private static $name;

    /**
     * Arguments passed as array from the sttic call.
     */
    private static $arguments;

    /**
     * The array of aliases from Config file
     */
    private static $alias;

    /**
     * The class name extracted from alias array
     */
    private static $calledClass;

    /**
     * The method who process and call the alias class
     */
    public static function init($namespace, $name, $arguments)
    {
        self::$namespace = $namespace;
        self::$name = $name;
        self::$arguments = $arguments;

        $classShort = self::getClassNameFromNamespace();
        self::$alias = self::injectConfig();

        self::$calledClass = self::$alias[$classShort];

        if(isset(self::$calledClass))
        {
            $reflection = new \ReflectionClass(self::$calledClass);
            if($reflection->hasMethod($name))
            {
                return self::callMethod($reflection);
            }
        }
    }

    /**
     * Extract the short class name from namespace
     */
    public static function getClassNameFromNamespace()
    {
        $classArray = explode("\\",  self::$namespace);
        return $classArray[count($classArray) - 1];
    }

    /**
     * Call the Injector and receive and instance of Config class
     */
    public static function injectConfig()
    {
        $app = new App();
        return $app->alias;;
    }

    /**
     * Extract the short class name from namespace
     */
    public static function callMethod($reflection)
    {
        $newClass = new self::$calledClass();
        $method = $reflection->getMethod(self::$name);

        return call_user_func_array(array($newClass, $method->name), self::$arguments);
    }
}
