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

    public function select()
    {
        $user = new User();
        $user = $user->where("id", ">", 1)->selectOne();
        dd($user);
        //$users = $user->where("id", ">", "0")->select();
        //$users = $user->sortBy("first_name", "DESC")->selectAll();

        //$user->getClass();

    }

    public function create()
    {
        $user = new User();
        $newUser = $user->create([
            "first_name" => "Popa",
            "last_name" => "Alexandru",
            "username" => "alexandru.popa",
            "password" => "high",
            "email" => "alexandru@gmail.com"
        ]);

        dd($newUser);
    }

    public function update()
    {
        $user = new User();
        $user->where("first_name", "=", "Popa")->update([
            "first_name" => "Popa",
            "last_name" => "Anca",
            "username" => "anca.popa",
            "password" => "high",
            "email" => "anca@gmail.com"
        ]);
    }

    public function delete()
    {
        $user = new User();
        $user = $user->where("id", ">", 4)->delete();
    }
}
