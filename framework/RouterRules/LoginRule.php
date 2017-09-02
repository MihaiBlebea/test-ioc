<?php

namespace Framework\RouterRules;

use Framework\Interfaces\RouterRuleInterface;
use Framework\Injectables\Injector;

class LoginRule implements RouterRuleInterface
{
    public static function apply($params = null)
    {
        $login = Injector::resolve("Login");
        if($login)
        {
            return true;
        } else {
            self::fail();
        }
    }

    public static function fail()
    {
        $router = Injector::resolve("Router");
        $router->goTo(["controller" => "Index", "action" => "index"]);
    }
}
