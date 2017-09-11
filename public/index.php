<?php

require_once('helpers.php');
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use Framework\App as Frame;
use Framework\Injectables\Injector;

define("__LOG_PATH__", "../log/");

$frame = new Frame();

$frame->boot();

$frame->init();
