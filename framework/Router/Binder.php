<?php

namespace Framework\Router;

use Framework\Injectables\Injector;

class Binder
{
    private static $namespace;

    private static $params;

    public static function bind(array $params, array $models)
    {
        $config = Injector::resolve("Config");
        self::$namespace = $config->getConfig("application")["model_namespace"];

        self::$params = array_values($params);

        $result = array();
        foreach($models as $index => $model)
        {
            if(self::resolveBind($index, $model) !== false)
            {
                array_push($result, self::resolveBind($index, $model));
            }
        }
        return $result;
    }

    private static function resolveBind($index, $model)
    {
        $class = self::$namespace . $model;
        $class = new $class();

        $found = $class->where(self::$params[$index]["id"], "=", self::$params[$index]["param"])->selectOne();
        if($found !== false)
        {
            return $found;
        } else {
            return self::$params[$index]["param"];
        }
    }
}
