<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Sessions\PreviousPathSession;

class PreviousPathSessionComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('PreviousPathSession', function() {
            $session = new PreviousPathSession();
            $path = ltrim(substr($_SERVER['REQUEST_URI'], strlen(implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/') - 1), '/');
            $session->setContent($path);
            return $session;
        });
    }

    public function run($instance)
    {

    }
}
