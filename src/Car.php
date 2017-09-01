<?php

namespace TestIoc;

class Car
{
    public $fuel;

    public function __construct(Fuel $fuel)
    {
        $this->fuel = $fuel;
    }

    public function getCar()
    {
        //dd($this->fuel);
        return "This car uses " . $this->fuel->type . " and burns " . $this->fuel->amount . " per day.";
    }
}
