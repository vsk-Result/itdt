<?php

namespace App\UseCases\Inventory\Consumable;

use App\Models\Inventory\Consumables\Consumable;
use App\Models\Inventory\Consumables\Replacement;
use App\Models\Inventory\Printer\Printer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplacementService
{
    public function create($userId, $consumableId, Request $request): Replacement
    {
        $user = User::findOrFail($userId);
        $consumable = Consumable::findOrFail($consumableId);
        $printer = Printer::findOrFail($request['printer_id']);

        return DB::transaction(function () use ($request, $user, $consumable, $printer) {

            $replacement = Replacement::make([
                'printer_id' => $request['printer_id'],
                'object_id' => $printer->object_id,
                'comment' => $request['comment'],
                'replaced_at' => Carbon::parse($request['replaced_at'])->format('Y-m-d H:i:s'),
            ]);

            $replacement->user()->associate($user);
            $replacement->consumable()->associate($consumable);
            $replacement->saveOrFail();

            return $replacement;
        });
    }

    public function update($id, Request $request): void
    {
        $replacement = $this->getReplacement($id);
        $printer = Printer::findOrFail($request['printer_id']);
        $replacement->update([
            'printer_id' => $request['printer_id'],
            'object_id' => $printer->object_id,
            'comment' => $request['comment'],
            'replaced_at' => Carbon::parse($request['replaced_at'])->format('Y-m-d H:i:s'),
        ]);
    }

    public function destroy($id): void
    {
        $replacement = $this->getReplacement($id);
        $replacement->delete();
    }

    private function getReplacement($id): Replacement
    {
        return Replacement::findOrFail($id);
    }
}