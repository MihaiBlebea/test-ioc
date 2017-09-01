<?php

namespace TestIoc;

class House
{
    public $address;

    public function __construct($address)
    {
        $this->address = $address;
    }
}
