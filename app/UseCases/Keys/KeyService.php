<?php

namespace App\UseCases\Keys;

use App\Models\Keys\Key;
use App\Models\Keys\Usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeyService
{
    public function create(Request $request): Key
    {
        return DB::transaction(function () use ($request) {

            $key = Key::make([
                'user_id' => Auth::id(),
                'key' => $request->key,
                'login' => $request->login,
                'password' => $request->password,
                'product' => $request->product,
                'expire_date' => $request->expire_date,
                'renewal_id' => $request->renewal_id,
            ]);

            $key->saveOrFail();

            $this->updateUsages($key->id, $request);

            return $key;
        });
    }

    public function update($id, Request $request): Key
    {
        $key = $this->getKey($id);
        $key->update([
            'login' => $request->login,
            'password' => $request->password,
            'product' => $request->product,
            'expire_date' => $request->expire_date,
            'renewal_id' => $request->renewal_id,
//            'created_at' => $request->created_at,
        ]);

        $this->updateUsages($key->id, $request);

        return $key;
    }

    public function destroy($id)
    {
        $key = $this->getKey($id);
        $key->usages()->delete();
        $key->delete();
    }

    public function getKey($id) : Key
    {
        return Key::findOrFail($id);
    }

    public function updateUsages($id, Request $request)
    {
        $key = $this->getKey($id);
        $key->usages()->delete();

        if (!isset($request->user_name) && !isset($request->PC_name) && !isset($request->IP)) {
            return;
        }

        foreach ($request->user_name as $index => $user_name) {

            if (is_null($request->user_name[$index]) && is_null($request->PC_name[$index]) && is_null($request->IP[$index])) {
                continue;
            }

            $usage = Usage::make([
                'user_id' => Auth::id(),
                'key_id' => $key->id,
                'user_name' => $request->user_name[$index],
                'PC_name' => $request->PC_name[$index],
                'IP' => $request->IP[$index]
            ]);
            $usage->saveOrFail();
        }
    }

    public function changeRenewalUse($id)
    {
        $key = $this->getKey($id);
        $key->update([
           'is_renewal_use' => !$key->is_renewal_use
        ]);
    }
}