<?php

require_once('helpers.php');
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use TestIoc\App;
use TestIoc\Car;
use TestIoc\Fuel;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

//$app = new App;
App::register('car', function() {
    $fuel = new Fuel();
    $car = new Car($fuel);
    return $car;
});


$car = App::resolve('car');

dd($car->getCar());
