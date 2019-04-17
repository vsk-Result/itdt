<?php

namespace App\UseCases\Inventory\Consumable;

use App\Models\Inventory\Consumables\Consumable;
use App\Models\Inventory\Consumables\Movement;
use App\Models\Inventory\Consumables\Stock;
use App\Models\Objects\CObject;

class StockService
{
    public function update($consumable_id): void
    {
        $consumable = Consumable::findOrFail($consumable_id);
        $object_ids = array_unique(
            array_merge(
                $consumable->movements()->whereNull('deleted_at')->pluck('sender_id')->toArray(),
                $consumable->movements()->whereNull('deleted_at')->pluck('recipient_id')->toArray()
            )
        );
        if (auth()->id() == 1) dd($object_ids);
        $consumable->stocks()->whereNotIn('object_id', $object_ids)->delete();

        foreach ($object_ids as $object_id) {
            if (is_null($object_id)) continue;

            $count = $this->calculateStockCount(
                $consumable->movements()->where('recipient_id', $object_id)->where('status', Movement::STATUS_CONFIRMED)->sum('count'),
                $consumable->movements()->writeOff()->where('recipient_id', $object_id)->where('status', Movement::STATUS_CONFIRMED)->sum('count'),
                $consumable->movements()->where('sender_id', $object_id)->where('status', Movement::STATUS_CONFIRMED)->sum('count'),
                $consumable->replacements()->where('object_id', $object_id)->count()
            );

            if ($stock = $consumable->stocks()->where('object_id', $object_id)->first()) {
                $stock->update(compact('count'));
            } else {
                $stock = Stock::create(compact('object_id', 'consumable_id', 'count'));
            }

            if ($count == 0) $stock->delete();
        }
    }

    private function calculateStockCount($arrival, $write_off, $consumption, $replaces): int
    {
        return $arrival - $write_off - $consumption - $replaces;
    }
}