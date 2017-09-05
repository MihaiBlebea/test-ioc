<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Router\Request;

class RequestComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Request', function() {
            $request = new Request();
            return $request;
        });
    }

    public function run($instance)
    {
    
    }
}
