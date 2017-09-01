<?php

namespace TestIoc\Engines;

class Engine
{
    private $capacity;
    private $maxSpeed;
    private $uses;

    public function __construct($capacity, $maxSpeed, $uses)
    {
        $this->capacity = $capacity;
        $this->maxSpeed = $maxSpeed;
        $this->uses = $uses;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    public function getFuel()
    {
        return $this->fuel;
    }

}
