<?php

require_once('helpers.php');
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use TestIoc\App;
use TestIoc\Car;
use TestIoc\Fuel;


App::bootWhoops();
App::boot();

$car = App::resolve('car');
$client = App::resolve('client');

var_dump($car->getCar());
var_dump($client->buy());
