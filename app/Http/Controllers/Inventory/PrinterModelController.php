<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Printer\PModel;
use App\UseCases\Inventory\Printer\ModelService;
use Illuminate\Http\Request;

class PrinterModelController extends Controller
{
    private $service;

    public function __construct(ModelService $service)
    {
        $this->middleware('permission:consumables');
        $this->service = $service;
    }

    public function store(Request $request)
    {
        try {
            $model = $this->service->create($request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }

    public function edit($id)
    {
        $model = $this->service->getModel($id);
        return response()->json(compact('model'));
    }

    public function update($id, Request $request)
    {
        try {
            $this->service->update(
                $id,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }

    public function destroy($id)
    {
        try {
            $this->service->destroy($id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }
}
