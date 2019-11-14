<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Printer\PModel;
use App\Models\Objects\CObject;
use App\UseCases\Inventory\Order\ExportService;
use App\UseCases\Inventory\Order\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
        $objects = CObject::getList(false, true);
        $printer_models = PModel::with('consumables', 'consumables.color')->get();
        return view('inventory.consumables.order', compact('printer_models', 'objects'));
    }

    public function store(Request $request)
    {

        try {
            $order = $this->service->create(
                Auth::id(),
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return $this->export->download($order);
    }
}
