<?php

use App\Controllers\FulfillmentOrderController;
use App\Controllers\HomeController;
use App\Controllers\InventoryController;
use Core\Router;

$router = new Router();
$router->add('/', HomeController::class, 'index');
$router->add('/inventory', InventoryController::class, 'index');
$router->add('/fulfillment-orders', FulfillmentOrderController::class, 'index');

return $router;
