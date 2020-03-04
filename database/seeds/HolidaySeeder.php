<?php

use Illuminate\Database\Seeder;
use App\Models\Holiday;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holidays = [
            ['name' => 'Новогодние каникулы', 'date' => '01-01'],
            ['name' => 'Новогодние каникулы', 'date' => '01-02'],
            ['name' => 'Новогодние каникулы', 'date' => '01-03'],
            ['name' => 'Новогодние каникулы', 'date' => '01-04'],
            ['name' => 'Новогодние каникулы', 'date' => '01-05'],
            ['name' => 'Новогодние каникулы', 'date' => '01-06'],
            ['name' => 'Рождество Христово', 'date' => '01-07'],
            ['name' => 'Новогодние каникулы', 'date' => '01-08'],
            ['name' => 'День защитника Отечества', 'date' => '02-23'],
            ['name' => 'Международный женский день', 'date' => '03-08'],
            ['name' => 'Выходной', 'date' => '03-09'],
            ['name' => 'Короткий день', 'date' => '04-30'],
            ['name' => 'Праздник Весны и Труда', 'date' => '05-01'],
            ['name' => 'День Победы', 'date' => '05-09'],
            ['name' => 'Короткий день', 'date' => '05-08'],
            ['name' => 'Выходной', 'date' => '05-11'],
            ['name' => 'День России', 'date' => '06-12'],
            ['name' => 'Короткий день', 'date' => '06-11'],
            ['name' => 'День народного единства', 'date' => '11-04'],
            ['name' => 'Короткий день', 'date' => '11-03'],
            ['name' => 'Короткий день', 'date' => '12-31'],
            ['name' => 'Выходной', 'date' => '02-24'],
            ['name' => 'Выходной', 'date' => '05-04'],
            ['name' => 'Выходной', 'date' => '05-05'],
        ];

        Holiday::insert($holidays);
    }
}