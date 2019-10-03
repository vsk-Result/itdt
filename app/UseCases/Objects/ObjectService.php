<?php

namespace App\UseCases\Objects;

use App\Models\Objects\CObject;
use App\Services\Upload\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectService
{
    private $uploader;
    private $imageService;
    private $infoPartService;
    private $personService;

    public function __construct(Uploader $uploader, ImageService $imageService, InfoPartService $infoPartService, PersonService $personService)
    {
        $this->uploader = $uploader;
        $this->imageService = $imageService;
        $this->infoPartService = $infoPartService;
        $this->personService = $personService;
    }

    public function create(Request $request): CObject
    {
        return DB::transaction(function () use ($request) {

            $object = CObject::make([
                'code' => $request->code,
                'name' => $request->name,
                'address' => $request->address,
            ]);
            $object->saveOrFail();

            $this->updateImage($object->id, $request->file('image'));
            $this->updateGallery($object->id, $request);
            $this->updateInfoParts($object->id, $request);
            $this->updatePersons($object->id, $request);

            return $object;
        });
    }

    public function update($id, Request $request): CObject
    {
        $object = $this->getObject($id);
        $object->update([
            'code' => $request->code,
            'name' => $request->name,
            'address' => $request->address,
            'is_active' => isset($request->is_active),
        ]);

        $this->updateImage($object->id, $request->file('image'));
        $this->updateGallery($object->id, $request);
        $this->updateInfoParts($object->id, $request);
        $this->updatePersons($object->id, $request);

        return $object;
    }

    public function destroy($id): void
    {
        $article = $this->getArticle($id);
        $article->tags()->sync([]);
        $article->delete();
    }

    public function getObject($id): CObject
    {
        return CObject::findOrFail($id);
    }

    public function updateImage($id, $image)
    {
        $object = $this->getObject($id);

        $filename = $this->uploader->upload(
            $image,
            CObject::getDestinationPath()
        );

        if (!is_null($filename)) {
            $object->update([
                'image' => $filename
            ]);
        }

        return $object;
    }

    public function updateGallery($id, Request $request)
    {
        $object = $this->getObject($id);

        if (isset($request->image_id)) {
            foreach ($request->image_id as $index => $image_id) {
                if (is_null($request->image_description[$index])) continue;
                $this->imageService->updateDescription($image_id, $request->image_description[$index]);
            }
        }

        if (isset($request->image_delete)) {
            $this->imageService->destroy($request->image_delete);
        }

        $files = $request->file('gallery_files');
        if ($files) {
            foreach ($files as $file) {
                $this->imageService->create($object->id, $file);
            }
        }

        return $object;
    }

    public function updateInfoParts($id, Request $request)
    {
        $object = $this->getObject($id);

        if (isset($request->title)) {
            foreach ($request->title as $index => $title) {
                if (is_null($title)) continue;
                if (isset($request->ip_id) && $request->ip_id[$index] != 'none') {
                    $this->infoPartService->update($object->id, $index, $request);
                } else {
                    $this->infoPartService->create($object->id, $index, $request);
                }
            }
        }

        return $object;
    }

    public function updatePersons($id, Request $request)
    {
        $object = $this->getObject($id);

        if (isset($request->fullname)) {
            foreach ($request->fullname as $index => $fullname) {
                if (is_null($fullname)) continue;
                if (isset($request->p_id) && $request->p_id[$index] != 'none') {
                    $this->personService->update($object->id, $index, $request);
                } else {
                    $this->personService->create($object->id, $index, $request);
                }
            }
        }

        return $object;
    }

    public function reorderInfoParts(array $order)
    {
        $this->infoPartService->reorder($order);
    }
}