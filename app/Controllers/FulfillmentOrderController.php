<?php

namespace App\Controllers;

use App\Libs\SpApi\FulfillmentOrders;

class FulfillmentOrderController extends BaseController
{
    public function index()
    {
        $startTime = (new \DateTime(date('Y-m-d H:i:s')))->modify('-1 year');
        $inventory = (new FulfillmentOrders())->getAll($startTime);

        $this->display('fulfillment-orders/index', ['inventory' => $inventory]);
    }
}
