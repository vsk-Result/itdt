<?php

namespace App\UseCases\Inventory\Printer;

use App\Models\Inventory\Printer\PModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModelService
{
    public function create(Request $request): PModel
    {
        return DB::transaction(function () use ($request) {

            $model = PModel::make([
                'name' => $request['name'],
            ]);

            $model->saveOrFail();

            return $model;
        });
    }

    public function update($id, Request $request): void
    {
        $model = $this->getModel($id);
        $model->update($request->only([
            'name',
        ]));
    }

    public function destroy($id): void
    {
        $model = $this->getModel($id);
        $model->delete();
    }

    public function getModel($id): PModel
    {
        return PModel::findOrFail($id);
    }
}