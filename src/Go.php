<?php

namespace TestIoc;

use Framework\InjectionContainer;

class Go
{
    public function view()
    {
        $inj = new InjectionContainer;
        $car = $inj->resolve("car");
        echo $car->getCar();

        $house = $inj->resolve("house");
        echo $house->address;
    }
}
