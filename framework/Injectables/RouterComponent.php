<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Router\Router;

class RouterComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Router', function() {
            $router = new Router();
            return $router;
        });
    }

    public function run($instance)
    {
        $instance->run();
    }
}
