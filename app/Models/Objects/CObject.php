<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class CObject extends Model
{
    protected $table = 'objects';

    const DEFAULT_FILENAME = 'object_default.jpg';

    public function images()
    {
        return $this->hasMany(Image::class, 'object_id');
    }

    public function infoparts()
    {
        return $this->hasMany(InfoPart::class, 'object_id');
    }

    public function persons()
    {
        return $this->hasMany(Person::class, 'object_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\TaskManager\Task', 'object_id');
    }

    public function getFullName()
    {
        return $this->code . ' - ' . $this->name;
    }

    public function getDestinationPath() {
        return 'objects/';
    }

    public function getImageUrl()
    {
        return \Storage::url($this->getImagePath());
    }

    public function getImagePath()
    {
        $filename = is_null($this->image) ? self::DEFAULT_FILENAME : $this->image;
        return $this->getDestinationPath() . $filename;
    }

    public static function getList()
    {
        $lists = [null => ''];
        foreach (self::orderBy('code')->get() as $object) {
            $lists[$object->id] = $object->getFullName();
        }
        return $lists;
    }

    public function getTasksPercentage()
    {
        $active_tasks = $this->tasks()->active()->count();
        return $active_tasks == 0 ? 0 : round($this->tasks()->active()->tasks()->count() * 100 / $active_tasks, 0);
    }

    public function getPurchasesPercentage()
    {
        $active_tasks = $this->tasks()->active()->count();
        return $active_tasks == 0 ? 0 : round($this->tasks()->active()->purchases()->count() * 100 / $active_tasks, 0);
    }

    public function getEvolutionsPercentage()
    {
        $active_tasks = $this->tasks()->active()->count();
        return $active_tasks == 0 ? 0 : round($this->tasks()->active()->evolutions()->count() * 100 / $active_tasks, 0);
    }

    public function getSolvedTasksCount()
    {
        return $this->tasks()->solved()->count();
    }
}
