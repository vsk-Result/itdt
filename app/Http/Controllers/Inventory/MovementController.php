<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Consumables\Consumable;
use App\Models\Inventory\Consumables\Movement;
use App\UseCases\Inventory\Consumable\MovementService;
use App\UseCases\Inventory\Consumable\StockService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    private $service;
    private $stockService;

    public function __construct(MovementService $service, StockService $stockService)
    {
        $this->service = $service;
        $this->stockService = $stockService;
    }

    public function store(Request $request, Consumable $consumable)
    {
        try {
            $movement = $this->service->create(
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

    public function edit(Consumable $consumable, Movement $movement)
    {
        return response()->json(compact('movement'));
    }

    public function update(Request $request, Consumable $consumable, Movement $movement)
    {
        try {
            $this->service->update(
                $movement->id,
                $request
            );
            $this->stockService->update($consumable->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }

    public function destroy(Consumable $consumable, Movement $movement)
    {
        try {
            $this->service->destroy($movement->id);
            $this->stockService->update($consumable->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }

    public function confirm(Consumable $consumable, Movement $movement)
    {
        try {
            $this->service->confirm($movement->id);
            $this->stockService->update($consumable->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }

    public function pending(Consumable $consumable, Movement $movement)
    {
        try {
            $this->service->pending($movement->id);
            $this->stockService->update($consumable->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('inventory.consumables.show', $consumable);
    }
}
