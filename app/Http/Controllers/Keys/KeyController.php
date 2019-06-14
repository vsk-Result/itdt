<?php

namespace App\Http\Controllers\Keys;

use App\Http\Controllers\Controller;
use App\Models\Keys\Key;
use App\UseCases\Keys\KeyService;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    private $service;

    public function __construct(KeyService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $keys = Key::all();
        $renewalList = [null => 'Использован'] + Key::with('usages')->orderByDesc('expire_date')->pluck('login', 'id')->toArray();
        return view('keys.index', compact('keys', 'renewalList'));
    }

    public function store(Request $request)
    {
        $key = $this->service->create($request);
        return redirect()->back();
    }

    public function edit($id)
    {
        $key = $this->service->getKey($id);
        $usages = '';
        if ($key->usages->count() > 0) {
            foreach ($key->usages as $usage) {
                $usages .= view('keys.partials.usage_row', compact('usage'))->render();
            }
        } else {
            $usages = view('keys.partials.usage_row')->render();
        }
        return response()->json(compact('key', 'usages'));
    }

    public function update($id, Request $request)
    {
        $key = $this->service->update($id, $request);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->back();
    }

    public function getPassword($id, Request $request)
    {
        $key = $this->service->getKey($id);
        $password = $request->status == 'open' ? $key->getHiddenPassword() : $key->password;
        $status = $request->status == 'open' ? 'hidden' : 'open';
        return response()->json(compact('password', 'status'));
    }
}