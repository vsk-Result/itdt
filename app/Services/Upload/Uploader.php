<?php

namespace App\Services\Upload;

use Intervention\Image\ImageManagerStatic as IImage;

class Uploader
{
    const RANDOM_NUMBER = 6;

    public function upload($file, $path)
    {
        if (empty($file) && is_null($file)) {
            return null;
        }

        $filename = str_random(self::RANDOM_NUMBER) . '_' . rus2translit($file->getClientOriginalName());
        $file->storeAs($path, $filename);

        if ($this->isImage(storage_path('app/public/' . $path) . $filename)) {
            $this->makeThumb($path, $filename, null, 140, true);
        }

        return $filename;
    }

    public function makeThumb($path, $filename, $width = null, $height = null, bool $aspect = false)
    {
        $path = storage_path('app/public/' . $path);
        IImage::make($path . $filename)
            ->resize($width, $height, function ($constraint) use ($aspect) {
                if ($aspect) {
                    $constraint->aspectRatio();
                }
            })->save($path . 'thumbs/' . $filename);
    }

    public function isImage($filename)
    {
        $is = @getimagesize($filename);
        if (!$is) return false;
        elseif (!in_array($is[2], array(1, 2, 3))) return false;
        else return true;
    }
}