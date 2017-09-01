<?php

namespace TestIoc;

class Client
{
    public $fuel;

    public function __construct(Fuel $fuel)
    {
        $this->fuel = $fuel;
    }

    public function buy()
    {
        return "I want to but " . $this->fuel->amount . " for " . $this->fuel->price . " $.";
    }
}
