<?php

namespace Framework\Components;

use Framework\InjectionContainer;
use TestIoc\Car;
use TestIoc\Fuel;

class CarComponent extends InjectionContainer
{
    public function boot()
    {
        self::register('car', function() {
            $fuel = new Fuel();
            $car = new Car($fuel);
            return $car;
        });
    }
}
