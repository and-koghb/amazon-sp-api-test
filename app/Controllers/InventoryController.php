<?php

namespace App\Controllers;

use App\Libs\SpApi\FbaInventory;

class InventoryController extends BaseController
{
    public function index()
    {
        $inventory = (new FbaInventory())->getData(true);

        $this->display('inventory/index', ['inventory' => $inventory]);
    }
}
