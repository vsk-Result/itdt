<?php

namespace App\UseCases\Inventory\Sparepart;

use App\Models\Inventory\Printer\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparepartService
{
    public function create(Request $request): Sparepart
    {
        return DB::transaction(function () use ($request) {

            $sparepart = Sparepart::make([
                'name' => $request['name'],
                'model_id' => $request['model_id'],
                'user_id' => auth()->id(),
                'part_number' => $request['part_number'],
                'url' => $request['url'],
            ]);

            $sparepart->saveOrFail();

            return $sparepart;
        });
    }

    public function update($id, Request $request): void
    {
        $sparepart = $this->getSparepart($id);
        $sparepart->update($request->only([
            'name',
            'model_id',
            'part_number',
            'url'
        ]));
    }

    public function destroy($id): void
    {
        $sparepart = $this->getSparepart($id);
        $sparepart->delete();
    }

    private function getSparepart($id): Sparepart
    {
        return Sparepart::findOrFail($id);
    }
}