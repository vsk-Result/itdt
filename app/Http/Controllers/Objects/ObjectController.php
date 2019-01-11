<?php

namespace App\Http\Controllers\Objects;

use App\Models\Objects\CObject;
use App\Models\Objects\InfoPart;
use App\Models\Objects\InfoPartAttachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ObjectController extends Controller
{
    public function index()
    {
        $objects = CObject::orderBy('code')->get();
        return view('objects.index', compact('objects'));
    }

    public function create()
    {
        return view('objects.create');
    }

    public function store(Request $request)
    {
        $object = new CObject();
        $object->code = $request->code;
        $object->name = $request->name;
        $object->address = $request->address;
        $object->image = null;
        $object->save();

        $image = $request->file('image');
        if (!empty($image) && !is_null($image)) {
            $filename = $object->id . '_' . str_random(2) . '_' . rus2translit($image->getClientOriginalName());
            $image->storeAs($object->getDestinationPath(), $filename);
            $object->image = $filename;
        } else {
            $object->image = null;
        }
        $object->update();

        if (isset($request->title)) {
            foreach ($request->title as $index => $title) {
                $infopart = new InfoPart();
                $infopart->object_id = $object->id;
                $infopart->title = $title;
                $infopart->body = isset($request->content) ? $request->content[$index] : '';
                $infopart->save();

                $infopart_files = $request->file('files_' . $index);
                if (is_array($infopart_files) && count($infopart_files) > 0) {
                    for ($i = 0; $i < count($infopart_files); $i++) {
                        $file = $infopart_files[$i];
                        $filename = $object->id . '_' . $infopart->id . '_' . str_random(2) . '_' . rus2translit($file->getClientOriginalName());
                        $file->storeAs($object->getDestinationPath(), $filename);

                        $attachment = new InfoPartAttachment();
                        $attachment->infopart_id = $infopart->id;
                        $attachment->filename = $filename;
                        $attachment->save();
                    }
                }
            }
        }

        return redirect()->route('objects.show', $object->id);
    }

    public function show($id)
    {
        $object = CObject::findOrFail($id);
        return view('objects.show', compact('object'));
    }

    public function createInfopart()
    {
        $infopart_render = view('objects.partials.new_infopart')->render();
        return response()->json(compact('infopart_render'));
    }
}
