<?php

require_once('helpers.php');
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use Framework\App as Frame;
use Framework\Injectables\Injector;

define("__LOG_PATH__", "../log/");

$frame = new Frame();

$frame->boot();


set_error_handler(function($errno, $errstr, $errfile, $errline) use ($frame) {
    $frame->setErrorHandler($errno, $errstr, $errfile, $errline);
});

//trigger_error("Value of $test must be 1 or less", E_USER_NOTICE);

$frame->init();
$con = Injector::resolve("Connector");

$test = $frame->testApp();

//dd($car);
