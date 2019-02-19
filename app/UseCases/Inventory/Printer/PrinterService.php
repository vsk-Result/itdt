<?php

namespace App\UseCases\Inventory\Printer;

use App\Models\Inventory\Printer\Printer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrinterService
{
    public function create(Request $request): Printer
    {
        return DB::transaction(function () use ($request) {

            $printer = Printer::make([
                'name' => $request['name'],
                'model_id' => $request['model_id'],
                'object_id' => $request['object_id'],
                'description' => $request['description'],
            ]);

            $printer->saveOrFail();

            return $printer;
        });
    }

    public function update($id, Request $request): void
    {
        $printer = $this->getPrinter($id);
        $printer->update($request->only([
            'name',
            'model_id',
            'object_id',
            'description'
        ]));
    }

    public function destroy($id): void
    {
        $printer = $this->getPrinter($id);
        $printer->delete();
    }

    private function getPrinter($id): Printer
    {
        return Printer::findOrFail($id);
    }
}