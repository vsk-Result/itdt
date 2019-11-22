<?php

use Illuminate\Database\Seeder;
use App\Models\TaskManager\Status;
use App\Models\TaskManager\Priority;
use App\Models\TaskManager\Type;
use App\Models\TaskManager\Task;
use App\Models\TaskManager\Subtask;
use App\Models\TaskManager\SubtaskComment;

class TaskManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name'=>'Открыта'],
            ['name'=>'Отложена'],
            ['name'=>'Решена'],
        ];

        Status::insert($statuses);

        $priorities = [
            ['name'=>'Высокий', 'class'=>'danger'],
            ['name'=>'Обычный', 'class'=>'primary'],
            ['name'=>'Низкий', 'class'=>'success'],
        ];

        Priority::insert($priorities);

        $typies = [
            ['name' => 'Закупка', 'color' => 'text-warning', 'icon' => 'icon-cart'],
            ['name' => 'Развитие', 'color' => 'text-success', 'icon' => 'icon-stats-growth'],
            ['name' => 'Задача', 'color' => '', 'icon' => ''],
        ];

        Type::insert($typies);

        factory(Task::class, 5)->create()->each(function(Task $task) {
            $task->subtasks()->saveMany(factory(Subtask::class, 3)->create()->each(function(Subtask $subtask) {
                $subtask->comments()->saveMany(factory(SubtaskComment::class, 3)->make());
            }));
        });
    }
}
