<?php

namespace TestIoc\Controllers;

use Framework\Injectables\Injector;
use Framework\Facades\RouterFacade;
use Framework\Facades\LoginFacade;

class IndexController
{
    public function index()
    {
        $car = Injector::resolve("Car");
        var_dump($car);

        $house = Injector::resolve("House");
        echo $house->address;
    }

    public function login()
    {
        $login = Injector::resolve('Login');
        $login->logUser('ceva');
        echo $login->getLoggedUser();
    }

    public function facade()
    {
        //$router = Injector::resolve("Router");
        //return $router->goTo(["controller" => "Index", "action" => "index"]);
        //RouterFacade::goTo(["controller" => "Index", "action" => "index"]);
        dd(LoginFacade::isLogin());
    }
}
