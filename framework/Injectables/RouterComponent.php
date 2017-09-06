<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Sessions\PreviousPathSession;
use Framework\Router\Router;
use Framework\Router\Request;
use Framework\Configs\Config;

class RouterComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Router', function() {
            $request = new Request();
            $session = new PreviousPathSession();
            $config  = new Config();
            $router  = new Router($request, $session, $config);
            return $router;
        });
    }

    public function run($instance)
    {
        $instance->get("ceva/:id/:id", "TestIoc\\Controllers\\IndexController@index")->as("Serban")->bind(["User", "User"])->rules([
            "LoginRule"      => "TestIoc\\Rules\\AdminRule",
            "MembershipRule" => "TestIoc\\Rules\\MembershipRule"
        ]);

        $instance->get("ceva/:masina/:foo/ceva4", ["option1" => "ceva", "option2" => "altceva"]);
        $instance->post("cevas", ["option1" => "Blebea", "option2" => "altceva"]);
        $instance->get("cevas", ["option1" => "Serban", "option2" => "altceva"]);
        $instance->compare();
    }
}
