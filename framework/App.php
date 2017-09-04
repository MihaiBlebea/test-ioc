<?php

namespace Framework;

use Framework\Injectables\Injector;

class App
{
    public $config = array();

    private $booted = false;

    private $routerActivated = false;

    private $errorHandlerActivated = false;

    public function __construct()
    {
        $config = require_once('../config/component.php');
        $this->config = $config;
    }

    public function boot()
    {
        foreach($this->config['components'] as $namespace)
        {
            $component = new $namespace();
            $component->boot();
        }
        $this->booted = true;
    }

    public function init()
    {
        foreach($this->config['components'] as $index => $namespace)
        {
            $instance = Injector::resolve($index);
            $component = new $namespace();
            $component->run($instance);
        }
    }

    public function autoloadAlias()
    {


    }

    public function testApp()
    {
        return [
            "booted" => $this->booted,
            "routerActivated" => $this->routerActivated,
            "errorHandlerActivated" => $this->errorHandlerActivated
        ];
    }
}
