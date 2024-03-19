<?php

require 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$router = require_once 'app/routes.php';
$router->handle($uri);
