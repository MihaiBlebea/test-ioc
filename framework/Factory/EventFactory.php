<?php

namespace Framework\Factory;

use Exception;
use Config;
use Framework\Injectables\Injector;

class EventFactory
{
    public static function build($type = "")
    {
        $config = Injector::resolve("Config");
        $config = $config->getConfig("application");

        if($type == "")
        {
             throw new Exception('No type given');
        } else {
            $className = $config["event_namespace"] . ucfirst($type) . "Event";

            if(class_exists($className))
            {
                return new $className();
            } else {
                throw new Exception($className . ' does not exist.');
            }
        }
    }
}
