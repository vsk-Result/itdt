<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $table = 'task_attachments';

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getUrl()
    {
        return Storage::url($this->getPath());
    }

    public function getPath()
    {
        return $this->task->getDestinationPath() . $this->filename;
    }

    public function getSize()
    {
        return round(Storage::size($this->getPath()) / 1024, 2) . ' КБ';
    }

    public function getExtension()
    {
        $dot_pos = strrpos($this->filename, '.');
        return substr($this->filename, $dot_pos);
    }

    public function getIcon()
    {
        $extension = $this->getExtension();

        if ($extension == '.doc' || $extension == '.docx') {
            return '<i class="icon-file-word icon-2x text-primary-300 top-0"></i>';
        }

        if ($extension == '.xls' || $extension == '.xlsx') {
            return '<i class="icon-file-excel icon-2x text-success-300 top-0"></i>';
        }

        if ($extension == '.pdf') {
            return '<i class="icon-file-pdf icon-2x text-danger-300 top-0"></i>';
        }

        if ($extension == '.jpg' || $extension == '.png') {
            return '<i class="icon-file-picture icon-2x text-violet-300 top-0"></i>';
        }

        return '<i class="icon-file-empty icon-2x text-primary-300 top-0"></i>';
    }

    public function getFilename()
    {
        $filename = substr($this->filename, 0, strrpos($this->filename, '.'));
        $extension = $this->getExtension();
        return strlen($filename) <= 20 ? $this->filename : (substr($filename, 0, 20) . '...' . $extension);
    }
}
