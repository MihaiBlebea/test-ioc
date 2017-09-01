<?php

namespace TestIoc\Cars;

abstract class Car
{
    abstract protected function run($distance);

    abstract protected function takes($people);

    abstract protected function charge($money);

    abstract protected function uses();

    final protected function profit()
    {
        return ($people * $money) - ($distance * $fuel * $money);
    }
}
