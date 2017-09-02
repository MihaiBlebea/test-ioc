<?php

namespace Framework\Router;

class GateKeeper
{
    private static $controllerRules = [
        "TestIoc\Controllers\IndexController" => [
            "Framework\RouterRules\LoginRule"
        ],
    ];

    public static function check($controller, $params)
    {
        $rules = self::getRules($controller);

        if(count($rules) > 0)
        {
            foreach($rules as $rule)
            {
                self::callRuleApply($rule, $params);
                /*
                if(self::callRuleApply($rule, $params) == false)
                {
                    die($rule::fail());
                }
                */
            }
        }
    }

    public static function getRules($controller)
    {
        if(isset(self::$controllerRules[$controller]))
        {
            return self::$controllerRules[$controller];
        }
    }

    public static function callRuleApply($namespace, $params)
    {
        return call_user_func_array(array($namespace, "apply"), $params);
    }

}
