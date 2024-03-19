<?php

require 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

//$router = require_once 'core/helpers.php';
//$t1 = config('ddd');
//echo '<pre>';var_dump($t1);
//$t2 = config('zzz');
//echo '<pre>';var_dump($t2);
$router = require_once 'app/routes.php';
$router->handle($uri);
