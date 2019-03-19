<?php

namespace App\Http\Controllers\Objects;

use App\Models\Objects\CObject;
use App\Models\Objects\Image;
use App\Models\Objects\InfoPart;
use App\Models\Objects\InfoPartAttachment;
use App\Models\Objects\Person;
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
                if (is_null($title)) continue;
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

        if (isset($request->fullname)) {
            foreach ($request->fullname as $index => $fullname) {
                if (is_null($fullname)) continue;
                $person = new Person();
                $person->object_id = $object->id;
                $person->fullname = $fullname;
                $person->appointment = isset($request->appointment) ? $request->appointment[$index] : '';
                $person->phone = isset($request->phone) ? $request->phone[$index] : '';
                $person->email = isset($request->email) ? $request->email[$index] : '';
                $person->link = isset($request->link) ? $request->link[$index] : '';
                $person->save();

                $image = $request->file('avatar_' . $index);
                if (!empty($image) && !is_null($image)) {
                    $filename = $object->id . '_' . $person->id . '_' . str_random(2) . '_' . rus2translit($image->getClientOriginalName());
                    $image->storeAs($object->getDestinationPath(), $filename);
                    $person->image = $filename;
                } else {
                    $person->image = null;
                }
                $person->update();
            }
        }

        $gallery_files = $request->file('gallery_files');
        if (is_array($gallery_files) && count($gallery_files) > 0) {
            for ($i = 0; $i < count($gallery_files); $i++) {
                $file = $gallery_files[$i];
                $filename = $object->id . '_' . str_random(2) . '_' . rus2translit($file->getClientOriginalName());
                $file->storeAs($object->getDestinationPath(), $filename);

                $attachment = new Image();
                $attachment->object_id = $object->id;
                $attachment->filename = $filename;
                $attachment->description = '';
                $attachment->order = 0;
                $attachment->save();
            }
        }

        return redirect()->route('objects.show', $object->id);
    }

    public function edit($id)
    {
        $object = CObject::findOrFail($id);
        return view('objects.edit', compact('object'));
    }

    public function update($id, Request $request)
    {
        $object = CObject::findOrFail($id);
        $object->code = $request->code;
        $object->name = $request->name;
        $object->address = $request->address;

        $image = $request->file('image');
        if (!empty($image) && !is_null($image)) {
            $filename = $object->id . '_' . str_random(2) . '_' . rus2translit($image->getClientOriginalName());
            $image->storeAs($object->getDestinationPath(), $filename);
            $object->image = $filename;
        }

        $object->update();

        if (isset($request->title)) {
            foreach ($request->title as $index => $title) {
                if (is_null($title)) continue;
                $infopart_id = $request->ip_id[$index];
                $infopart = $infopart_id == 'none' ? new InfoPart() : InfoPart::findOrFail($infopart_id);
                $infopart->object_id = $object->id;
                $infopart->title = $title;
                $infopart->body = isset($request->content) ? $request->content[$index] : '';
                $infopart_id == 'none' ? $infopart->save() : $infopart->update();

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

        if (isset($request->fullname)) {
            foreach ($request->fullname as $index => $fullname) {
                if (is_null($fullname)) continue;
                $person_id = $request->p_id[$index];
                $person = $person_id == 'none' ? new Person() : Person::findOrFail($person_id);
                $person->object_id = $object->id;
                $person->fullname = $fullname;
                $person->appointment = isset($request->appointment) ? $request->appointment[$index] : '';
                $person->phone = isset($request->phone) ? $request->phone[$index] : '';
                $person->email = isset($request->email) ? $request->email[$index] : '';
                $person->link = isset($request->link) ? $request->link[$index] : '';
                $person_id == 'none' ? $person->save() : $person->update();

                $image = $request->file('avatar_' . $index);
                if (!empty($image) && !is_null($image)) {
                    $filename = $object->id . '_' . $person->id . '_' . str_random(2) . '_' . rus2translit($image->getClientOriginalName());
                    $image->storeAs($object->getDestinationPath(), $filename);
                    $person->image = $filename;
                }

                $person->update();
            }
        }

        if (isset($request->image_id)) {
            foreach ($request->image_id as $index => $image_id) {
                $description = $request->image_description[$index];
                if (is_null($description)) continue;
                $image = Image::findOrFail($image_id);
                $image->description = $description;
                $image->update();
            }
        }

        if (isset($request->image_delete)) {
            Image::whereIn('id', $request->image_delete)->delete();
        }

        $gallery_files = $request->file('gallery_files');
        if (is_array($gallery_files) && count($gallery_files) > 0) {
            for ($i = 0; $i < count($gallery_files); $i++) {
                $file = $gallery_files[$i];
                $filename = $object->id . '_' . str_random(2) . '_' . rus2translit($file->getClientOriginalName());
                $file->storeAs($object->getDestinationPath(), $filename);

                $attachment = new Image();
                $attachment->object_id = $object->id;
                $attachment->filename = $filename;
                $attachment->description = '';
                $attachment->order = 0;
                $attachment->save();
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

    public function createPerson()
    {
        $person_render = view('objects.partials.new_person')->render();
        return response()->json(compact('person_render'));
    }

    public function word($id)
    {
        $object = CObject::findOrFail($id);

        $template_name = 'object_template.docx';
        $output_dir = 'app/public/temp_files/';
        $output_name = str_replace(' ', '_', $object->getFullName()) . '.docx';
        $output_path = $output_dir . $output_name;

        $PHPWord = new \PhpOffice\PhpWord\PhpWord();
        $document = $PHPWord->loadTemplate(public_path('/templates/' . $template_name));

        $document->setValue('object_name', $object->getFullName());
        $document->setValue('object_address', $object->address);
        $document->saveAs(storage_path($output_path));

        $headers = [
            'Content-Type' =>  'application/application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment;filename="' . $output_name . '"',
        ];

        return response()->download(storage_path($output_path), $output_name, $headers);
    }
}
