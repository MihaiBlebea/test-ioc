<?php

namespace TestIoc\Cars;

use TestIoc\Engines\Engine;

class SportCar extends Car
{
    private $engine;
    private $brand;

    private $distance;
    private $people;
    private $money;
    private $fuel;

    public function __construct(Engine $engine, $brand)
    {
        $this->engine = $engine;
    }

    public function run($distance)
    {
        $this->distance = $distance;
    }

    public function takes($people)
    {
        $this->people = $people;
    }

    public function charge($money)
    {
        $this->money = $money;
    }

    public function uses()
    {
        if($this->engine->getFuel() == "diesel")
        {
            $efficiency = 1.9;
        } elseif($this->engine->getFuel() == "petrol") {
            $efficiency = 2.5;
        }
        $this->fuel = $efficiency * $this->engine->getCapacity();
    }

    public function getStats()
    {
        return "The driver uses a " . $this->brand . " with a " . $this->engine->getCapacity() . "litres engine<br /> The journey is " . $this->distance . " km. He can take " . $this->people . "</br> The price per person will be " . $this->money . ". The profit will be " . $this->profit();
     }
}
