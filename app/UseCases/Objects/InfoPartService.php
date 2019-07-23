<?php

namespace App\UseCases\Objects;

use Illuminate\Http\Request;
use App\Models\Objects\InfoPart;
use App\Models\Objects\InfoPartAttachment;
use App\Services\Upload\Uploader;
use Illuminate\Support\Facades\DB;

class InfoPartService
{
    private $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function create($object_id, $index, Request $request): InfoPart
    {
        return DB::transaction(function () use ($object_id, $index, $request) {

            $infopart = InfoPart::make([
                'object_id' => $object_id,
                'icon_id' => $request->icon_id[$index],
                'title' => $request->title[$index],
                'body' => isset($request->content) ? $request->content[$index] : '',
                'order' => $this->getNewOrder()
            ]);
            $infopart->saveOrFail();

            $this->updateAttachments($infopart->id, $request->file('files_' . $index));

            return $infopart;
        });
    }

    public function update($object_id, $index, Request $request): InfoPart
    {
        return DB::transaction(function () use ($object_id, $index, $request) {

            $infopart = $this->getInfoPart($request->ip_id[$index]);
            $infopart->update([
                'object_id' => $object_id,
                'icon_id' => $request->icon_id[$index],
                'title' => $request->title[$index],
                'body' => isset($request->content) ? $request->content[$index] : ''
            ]);

            $this->updateAttachments($infopart->id, $request->file('files_' . $index));

            return $infopart;
        });
    }

    public function updateAttachments($id, $files)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $attachment = InfoPartAttachment::make([
                    'infopart_id' => $id,
                    'filename' => $this->uploader->upload(
                        $file,
                        InfoPartAttachment::getDestinationPath()
                    )
                ]);
                $attachment->saveOrFail();
            }
        }
    }

    public function getNewOrder()
    {
        return InfoPart::max('order') + 1;
    }

    private function getInfoPart($id): InfoPart
    {
        return InfoPart::findOrFail($id);
    }

    public function reorder(array $order)
    {
        foreach ($order as $index => $id) {
            $infopart = $this->getInfoPart($id);
            $infopart->update([
                'order' => $index
            ]);
        }
    }
}