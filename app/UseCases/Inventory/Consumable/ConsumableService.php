<?php

namespace App\UseCases\Inventory\Consumable;

use App\Models\Inventory\Consumables\Consumable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsumableService
{
    public function create(Request $request): Consumable
    {
        return DB::transaction(function () use ($request) {

            $consumable = Consumable::make([
                'name' => $request['name'],
                'color_id' => $request['color_id'],
            ]);

            $consumable->saveOrFail();
            $consumable->printers()->attach($request['printers']);

            return $consumable;
        });
    }

    public function update($id, Request $request): void
    {
        $consumable = $this->getConsumable($id);
        $consumable->update($request->only([
            'name',
            'color_id',
        ]));
        $consumable->printers()->sync($request['printers']);
    }

    public function destroy($id): void
    {
        $consumable = $this->getConsumable($id);
        $consumable->delete();
    }

    private function getConsumable($id): Consumable
    {
        return Consumable::findOrFail($id);
    }
}