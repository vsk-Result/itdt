<?php

use Illuminate\Database\Seeder;
use App\Models\Inventory\Consumables\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            ['name' => 'чёрный', 'hex_color' => '#000000'],
            ['name' => 'жёлтый', 'hex_color' => '#ffff00'],
            ['name' => 'пурпурный', 'hex_color' => '#800080'],
            ['name' => 'голубой', 'hex_color' => '#42aaff'],
            ['name' => 'серый', 'hex_color' => '#808080'],
            ['name' => 'чёрный матовый', 'hex_color' => '#000000'],
            ['name' => 'чёрный фото', 'hex_color' => '#000000'],
        ];

        Color::insert($colors);
    }
}
