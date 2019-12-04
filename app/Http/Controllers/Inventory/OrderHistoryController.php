<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Order\Order;
use App\UseCases\Inventory\Order\ExportService;
use App\UseCases\Inventory\Order\OrderService;

class OrderHistoryController extends Controller
{
    private $service;
    private $export;

    public function __construct(OrderService $service, ExportService $export)
    {
        $this->middleware('permission:consumables');
        $this->service = $service;
        $this->export = $export;
    }

    public function index()
    {
        $orders = $this->service->getPaginate(15);
        return view('inventory.consumables.orders.history', compact('orders'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('inventory.orders.history');
    }

    public function excel(Order $order)
    {
        return $this->export->download($order);
    }
}
