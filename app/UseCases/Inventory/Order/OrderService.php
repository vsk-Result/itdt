<?php

namespace App\UseCases\Inventory\Order;

use App\Models\Inventory\Order\Item;
use App\Models\Inventory\Order\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create($userId, Request $request): Order
    {
        $user = User::findOrFail($userId);

        return DB::transaction(function () use ($request, $user) {

            $order = new Order();
            $order->object_id = $request->object_id;
            $order->responsible = $request->responsible;
            $order->user()->associate($user);
            $order->saveOrFail();

            foreach ($request['counts'] as $index => $count) {
                if (is_null($count)) continue;

                $item = Item::make([
                    'consumable_id' => $request['consumable_ids'][$index],
                    'count' => $count
                ]);

                $item->order()->associate($order);
                $item->saveOrFail();
            }

            return $order;
        });
    }
}