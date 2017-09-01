<?php

namespace Framework\Components;

use Framework\InjectionContainer;
use TestIoc\House;

class HouseComponent extends InjectionContainer
{
    public function boot()
    {
        self::register('house', function() {
            $house = new House('UK, NW2 1UT');
            return $house;
        });
    }
}
