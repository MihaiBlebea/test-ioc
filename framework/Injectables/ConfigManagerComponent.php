<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Configs\ConfigManager;

class ConfigManagerComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('ConfigManager', function() {
            $config = new ConfigManager();
            return $config;
        });
    }

    public function run($instance)
    {

    }
}
