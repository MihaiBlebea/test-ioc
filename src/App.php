<?php

namespace TestIoc;

use Closure;
use TestIoc\Engines\Engine;
use TestIoc\Cars\SportCar;

class App
{
    private static $registry = array();

    public static function register($name, Closure $resolve)
    {
        static::$registry[$name] = $resolve;
    }

    public static function resolve($name)
    {
        if ( static::registered($name) )
        {
            $name = static::$registry[$name];
            return $name();
        }
        throw new \Exception('Nothing registered with that name, fool.');
    }

    public static function registered($name)
    {
       return array_key_exists($name, static::$registry);
    }

    // End of important methods that define IOC
    public static function getRegistry()
    {
        return self::$registry;
    }

    public static function boot()
    {
        self::register('sportcar', function() {
            $engine = new Engine(1.8, 180, 'diesel');
            $car = new SportCar($engine, 'BMW');
            $car->run(1000);
            $car->takes(3);
            $car->charge(23);
            return $car;
        });

        self::register('client', function() {
            $fuel = new Fuel();
            $client = new Client($fuel);
            return $client;
        });
    }

    public static function bootWhoops()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
}
