<?php

namespace TestIoc\Cars;

class FamilyCar extends Car
{
    public $fuel;

    public function __construct(Fuel $fuel)
    {
        $this->fuel = $fuel;
    }

    public function getCar()
    {
        return "This car uses " . $this->fuel->type . " and burns " . $this->fuel->amount . " per day.";
    }
}
