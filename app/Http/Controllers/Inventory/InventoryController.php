<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index()
    {
        $this->middleware('permission:consumables');
        return redirect()->route('inventory.consumables.index');
    }
}
