<?php

namespace TestIoc\Components;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use TestIoc\House;

class HouseComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('House', function() {
            $house = new House('UK, NW2 1UT');
            return $house;
        });
    }

    public function run($instance)
    {

    }
}
