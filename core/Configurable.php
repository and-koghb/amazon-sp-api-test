<?php

namespace Core;

class Configurable
{
    protected static $config = [];

    public function __construct()
    {
        if (!self::$config) {
            if (file_exists('config/app.local.php')) {
                self::$config = require_once 'config/app.local.php';
            } else {
                self::$config = require_once 'config/app.php';
            }
        }
    }
}
