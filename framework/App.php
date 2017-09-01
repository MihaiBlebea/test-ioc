<?php

namespace Framework;

use Closure;

class App
{
    public $config = array();

    public function __construct()
    {
        $config = require_once('../config/component.php');
        $this->config = $config;
    }

    public function boot()
    {
        foreach($this->configComponent['components'] as $namespace)
        {
            $component = new $namespace();
            $component->boot();
        }
    }
}
