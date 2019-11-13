<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Consumables\Consumable;
use App\Models\Inventory\Consumables\Movement;
use App\Models\Inventory\Consumables\Replacement;
use App\UseCases\Inventory\Consumable\ReplacementService;
use App\UseCases\Inventory\Consumable\StockService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReplacementController extends Controller
{
    private $service;
    private $stockService;

    public function __construct(ReplacementService $service, StockService $stockService)
    {
        $this->middleware('permission:consumables');
        $this->service = $service;
        $this->stockService = $stockService;
    }

    public function store(Request $request, Consumable $consumable)
    {
        try {
            $replacement = $this->service->create(
                Auth::id(),
                $consumable->id,
                $request
            );
            $this->stockService->update($consumable->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }

    public function edit(Consumable $consumable, Replacement $replacement)
    {
        $replaced_at = Carbon::parse($replacement->replaced_at)->format('Y-m-d');
        return response()->json(compact('replacement', 'replaced_at'));
    }

    public function update(Request $request, Consumable $consumable, Replacement $replacement)
    {
        try {
            $this->service->update(
                $replacement->id,
                $request
            );
            $this->stockService->update($consumable->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }

    public function destroy(Consumable $consumable, Replacement $replacement)
    {
        try {
            $this->service->destroy($replacement->id);
            $this->stockService->update($consumable->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }
}
