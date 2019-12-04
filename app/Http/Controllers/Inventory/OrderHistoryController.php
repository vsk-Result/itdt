<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Order\Order;
use App\UseCases\Inventory\Order\ExportService;

class OrderHistoryController extends Controller
{
    private $service;
    private $export;

    public function __construct(ExportService $export)
    {
        $this->middleware('permission:consumables');
        $this->export = $export;
    }

    public function index()
    {
        $orders = Order::paginate(15);
        return view('inventory.consumables.orderhistory.index', compact('orders'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('inventory.orderhistory.index');
    }

    public function store(Order $order)
    {
        return $this->export->download($order);
    }
}
