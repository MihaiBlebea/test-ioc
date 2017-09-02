<?php

namespace TestIoc\Controllers;

use Framework\Injectables\Injector;

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
}
