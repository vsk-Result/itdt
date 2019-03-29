<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Consumables\Color;
use App\Models\Inventory\Consumables\Consumable;
use App\Models\Inventory\Printer\PModel;
use App\Models\Inventory\Printer\Printer;
use App\Models\Objects\CObject;
use App\UseCases\Inventory\Consumable\ConsumableService;
use Illuminate\Http\Request;

class ConsumableController extends Controller
{
    private $service;

    public function __construct(ConsumableService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $consumables = Consumable::forPrinterModel($request->model_id)->with('color', 'stocks')->get();
            $render_view = view('inventory.consumables.list', compact('consumables'))->render();
            return response()->json(compact('render_view'));
        }

        $colors = Color::pluck('name', 'id');
        $objects = CObject::getList();
        $printer_models_list = PModel::pluck('name', 'id');
        $printer_models = PModel::with('consumables', 'consumables.color', 'consumables.stocks', 'consumables.stocks.object')->orderBy('name')->get();
        return view('inventory.consumables.index', compact('printer_models', 'printer_models_list', 'colors', 'objects'));
    }

    public function store(Request $request)
    {
        try {
            $consumable = $this->service->create($request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }

    public function edit(Consumable $consumable)
    {
        $printers = $consumable->printers()->pluck('id')->toArray();
        return response()->json(compact('consumable', 'printers'));
    }

    public function update(Request $request, Consumable $consumable)
    {
        try {
            $this->service->update(
                $consumable->id,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }

    public function destroy(Consumable $consumable)
    {
        try {
            $this->service->destroy($consumable->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.index');
    }

    public function show(Consumable $consumable)
    {
        $objects = CObject::getList();
        $printers = $consumable->getPrintersList();
        $colors = Color::pluck('name', 'id');
        $printer_models_list = PModel::pluck('name', 'id');

        return view('inventory.consumables.show', compact('consumable', 'objects', 'printers', 'colors', 'printer_models_list'));
    }
}
