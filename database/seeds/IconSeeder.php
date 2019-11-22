<?php

use Illuminate\Database\Seeder;
use App\Models\Icon;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $icons = [
            ['name' => 'icon-home'],
            ['name' => 'icon-home2'],
            ['name' => 'icon-home5'],
            ['name' => 'icon-home7'],
            ['name' => 'icon-home8'],
            ['name' => 'icon-home9'],
            ['name' => 'icon-office'],
            ['name' => 'icon-city'],
        ];

        Icon::insert($icons);
    }
}
