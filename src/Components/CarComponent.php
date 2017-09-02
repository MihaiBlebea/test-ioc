<?php

namespace TestIoc\Components;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use TestIoc\Car;
use TestIoc\Fuel;

class CarComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Car', function() {
            $fuel = new Fuel();
            $car = new Car($fuel);
            return $car;
        });
    }

    public function run($instance)
    {

    }
}
