<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Printer\Printer;
use App\UseCases\Inventory\Printer\PrinterService;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    private $service;

    public function __construct(PrinterService $service)
    {
        $this->middleware('permission:consumables');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $printers = Printer::forModel($request->model_id)->get();
            $render_view = view('inventory.printers.list', compact('printers'))->render();
            return response()->json(compact('render_view'));
        }
    }

    public function store(Request $request)
    {
        try {
            $printer = $this->service->create($request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }

    public function edit(Printer $printer)
    {
        return response()->json(compact('printer'));
    }

    public function update(Request $request, Printer $printer)
    {
        try {
            $this->service->update(
                $printer->id,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }

    public function destroy(Printer $printer)
    {
        try {
            $this->service->destroy($printer->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }
}
