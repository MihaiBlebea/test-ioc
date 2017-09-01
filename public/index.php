<?php

require_once('helpers.php');
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use TestIoc\Go;
use Framework\App as Frame;
use Framework\InjectionContainer;

$frame = new Frame();
$frame->boot();

/*
$inj = new InjectionContainer;
$car = $inj->resolve('car');
dd($car);
*/

$go = new Go();
$go->view();
