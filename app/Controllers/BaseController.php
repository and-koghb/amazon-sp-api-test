<?php

namespace App\Controllers;

use Core\Configurable;

class BaseController extends Configurable
{
    protected function display($view, $data = [])
    {
        extract($data);
        include 'app/Views/' . $view . '.php';
    }
}