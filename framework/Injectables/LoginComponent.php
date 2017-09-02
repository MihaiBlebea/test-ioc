<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Sessions\UsernameSession;
use Framework\Auth\Login;
use Framework\Factory\SessionFactory;

class LoginComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Login', function() {
            $session = new SessionFactory("Framework\\Sessions\\");
            $session = $session->build("username");
            $login = new Login($session);
            return $login;
        });
    }

    public function run($instance)
    {

    }
}
