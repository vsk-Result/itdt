<?php

use Illuminate\Database\Seeder;
use App\Models\Inventory\Printer\PModel;
use App\Models\Inventory\Consumables\Consumable;
use App\Models\Inventory\Printer\Printer;

class PrinterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PModel::class, 5)->create()->each(function($pmodel) {
            $pmodel->consumables()->createMany(
                factory(Consumable::class, 3)->make()->toArray()
            );
            $pmodel->printers()->createMany(
                factory(Printer::class, 3)->make()->toArray()
            );
        });
    }
}
