<?php

namespace TestIoc\Controllers;

use Framework\Injectables\Injector;
use Framework\Facades\RouterFacade;
use Framework\Facades\LoginFacade;
use TestIoc\Models\User;

class IndexController
{
    public function index()
    {
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
        //dd(LoginFacade::isLogin());

        LoginC::gethere();
    }

    public function pdo()
    {
        $user = new User();
        //$user = $user->select();
        $users = $user->selectAll();
        dd($users);
    }
}
