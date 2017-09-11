<?php

namespace TestIoc\Controllers;

use Framework\Injectables\Injector;
use Framework\Facades\RouterFacade;
use Framework\Facades\LoginFacade;
use TestIoc\Models\User;
use TestIoc\Models\Program;
use TestIoc\Managers\ChangePasswordManager;
use TestIoc\Emails\HelloEmail;
use Framework\Factory\EmailFactory;
use Framework\Templates\TemplateEngine;
use Framework\Alias\Template;
use Framework\Alias\Request;
use Framework\Alias\Router;
use Framework\Factory\EventFactory;
use Framework\Factory\ListenerFactory;

class IndexController
{
    public function index(User $user, Program $program)
    {
        dd($user);
    }

    public function login()
    {
        $login = Injector::resolve('Login');
        $login->logUser('ceva');
        echo $login->getLoggedUser();
    }

    public function facade()
    {
        Router::goToName("users")->with([
                "user"    => 1,
                "program" => 1
            ]);

    }

    public function select()
    {
        //tt();
        $user = new User();
        $user = $user->where("id", ">", 1)->selectOne();
        var_dump($user->generatePassword(8));

        /*
        Router::goToName("users")->with([
            "user"    => 1,
            "program" => 1
        ]);
        */
        $request = Injector::resolve("Request");
        dd($request->getPreviousPath());

        Router::navigateToUrl("/ceva/2/2");

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

    public function manager()
    {
        $manager = new ChangePasswordManager();
        $manager->run();
    }

    public function email()
    {
        //$email = new HelloEmail();
        //$email->send();

        $email = EmailFactory::build("HelloEmail");
        $email->send();
    }

    public function smarty()
    {
        $request = Injector::resolve("Request");
        dd($request->getPreviousPath());
        Template::setAssign([
            "error" => true
        ])->setDisplay("error.tpl");
    }

    public function alias()
    {
        /*
        $smarty = Injector::resolve("Template");
        $smarty->assign([
            "error" => true
        ]);
        $smarty->display("error.tpl");
        */

        Template::setAssign([
            "error" => true
        ])->setDisplay("error.tpl");

        //dd($test);
    }

    public function request(Request $request, $foo, $bar)
    {
        dd($request);
        //Request::retrive($data);
    }

    public function events()
    {
        $event    = EventFactory::build("Error");
        $listenerEmail = ListenerFactory::build("Email");
        $listenerLog = ListenerFactory::build("Log");
        $event->attach($listenerEmail, $listenerLog)->trigger("Serban");
    }
}
