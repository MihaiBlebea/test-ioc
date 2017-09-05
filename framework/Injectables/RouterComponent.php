<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Router\Router;
use Framework\Router\Request;

class RouterComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Router', function() {
            $request = new Request();
            $router = new Router($request);
            return $router;
        });
    }

    public function run($instance)
    {
        $instance->get("ceva/:id/:masina", ["option1" => "ceva", "option2" => "altceva"]);
        $instance->get("ceva/:masina/:foo/ceva4", ["option1" => "ceva", "option2" => "altceva"]);
        $instance->post("cevas", ["option1" => "Blebea", "option2" => "altceva"]);
        $instance->get("cevas", ["option1" => "Serban", "option2" => "altceva"]);
        $instance->compare();
    }
}
