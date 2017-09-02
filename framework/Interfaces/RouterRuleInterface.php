<?php

namespace Framework\Interfaces;

/**
 *
 */
interface RouterRuleInterface
{
    public static function apply($params = null);

    public static function fail();

}
