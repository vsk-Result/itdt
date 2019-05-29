<?php

namespace App\UseCases\Objects;

use App\Models\Objects\Image;
use App\Services\Upload\Uploader;
use Illuminate\Support\Facades\DB;

class ImageService
{
    private $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function create($object_id, $file): Image
    {
        return DB::transaction(function () use ($object_id, $file) {

            $image = Image::make([
                'object_id' => $object_id,
                'filename' => $this->uploader->upload(
                    $file,
                    Image::getDestinationPath()
                ),
                'order' => 0,
            ]);

            $image->saveOrFail();

            return $image;
        });
    }

    public function updateDescription($id, $description): Image
    {
        return DB::transaction(function () use ($id, $description) {

            $image = $this->getImage($id);
            $image->update(compact('description'));

            return $image;
        });
    }

    public function destroy($ids)
    {
        Image::whereIn('id', $ids)->delete();
    }

    public function getImage($id): Image
    {
        return Image::findOrFail($id);
    }
}