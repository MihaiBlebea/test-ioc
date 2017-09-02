<?php

namespace InstaRouter\Router\Rules;

use Framework\Router\Rules\Rule;
use InstaRouter\Auth\Login;

class AdminRule extends Rule
{
    public static function apply(...$params)
    {

    }

    public static function fail()
    {
        echo "You dont have permission";
    }
}
