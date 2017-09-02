<?php

require_once('helpers.php');
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use Framework\App as Frame;
use Framework\Injectables\Injector;

$frame = new Frame();
$frame->boot();
//$frame->run();
$frame->init();

$test = $frame->testApp();
$car = Injector::resolve("Car");
//dd($car);
