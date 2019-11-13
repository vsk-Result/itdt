<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Printer\Sparepart;
use App\UseCases\Inventory\Sparepart\SparepartService;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    private $service;

    public function __construct(SparepartService $service)
    {
        $this->middleware('permission:consumables');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $spareparts = Sparepart::forModel($request->model_id)->get();
            $render_view = view('inventory.spareparts.list', compact('spareparts'))->render();
            return response()->json(compact('render_view'));
        }
    }

    public function store(Request $request)
    {
        try {
            $sparepart = $this->service->create($request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }

    public function edit(Sparepart $sparepart)
    {
        return response()->json(compact('sparepart'));
    }

    public function update(Request $request, Sparepart $sparepart)
    {
        try {
            $this->service->update(
                $sparepart->id,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }

    public function destroy(Sparepart $sparepart)
    {
        try {
            $this->service->destroy($sparepart->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.index');
    }
}
