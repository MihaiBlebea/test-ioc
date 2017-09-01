<?php

require_once('helpers.php');
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use TestIoc\App;


App::bootWhoops();
App::boot();

$sportcar = App::resolve('sportcar');

var_dump($sportcar->getStats());
