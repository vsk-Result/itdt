<?php

namespace App\UseCases\Inventory\Consumable;

use App\Models\Inventory\Consumables\Consumable;
use App\Models\Inventory\Consumables\Movement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovementService
{
    public function create($userId, $consumableId, Request $request): Movement
    {
        $user = User::findOrFail($userId);
        $consumable = Consumable::findOrFail($consumableId);

        return DB::transaction(function () use ($request, $user, $consumable) {

            $movement = Movement::make([
                'sender_id' => isset($request['is_arrival']) ? null : $request['sender_id'],
                'recipient_id' => $request['recipient_id'],
                'count' => $request['count'],
                'comment' => $request['comment'],
                'status' => Movement::STATUS_PENDING,
                'is_arrival' => isset($request['is_arrival']) ? true : false,
            ]);

            $movement->user()->associate($user);
            $movement->consumable()->associate($consumable);
            $movement->saveOrFail();

            return $movement;
        });
    }

    public function update($id, Request $request): void
    {
        $movement = $this->getMovement($id);
        $movement->update($request->only([
            'recipient_id',
            'count',
            'comment',
        ]));
        $movement->update([
            'sender_id' => isset($request['is_arrival']) ? null : $request['sender_id'],
            'is_arrival' => isset($request['is_arrival']) ? true : false,
        ]);
    }

    public function destroy($id): void
    {
        $movement = $this->getMovement($id);
        $movement->delete();
    }

    public function confirm($id): void
    {
        $movement = $this->getMovement($id);
        $movement->confirm();
    }

    public function pending($id): void
    {
        $movement = $this->getMovement($id);
        $movement->pending();
    }

    private function getMovement($id): Movement
    {
        return Movement::findOrFail($id);
    }
}