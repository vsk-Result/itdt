<?php

namespace App\Http\Controllers\Objects;

use App\Models\Objects\CObject;
use App\Models\Objects\Image;
use App\Models\Objects\InfoPartAttachment;
use App\Models\Objects\Person;
use App\Services\Upload\Uploader;
use App\UseCases\Objects\ObjectService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ObjectController extends Controller
{
    private $service;
    private $uploader;

    public function __construct(ObjectService $service, Uploader $uploader)
    {
        $this->service = $service;
        $this->uploader = $uploader;
    }

    public function index()
    {
        if (auth()->id() == 1) {
            $objects = CObject::orderBy('code')->get();
            foreach ($objects as $object) {
                if (!is_null($object->image)) {
                    if (\Storage::disk('public')->exists('objects/' . $object->image)) {
                        \Storage::disk('public')->copy(
                            '/objects/' . $object->image,
                            CObject::getDestinationPath() . $object->image
                        );
                        $this->uploader->makeThumb(CObject::getDestinationPath(), $object->image, null, 140, true);
                    }
                }
                foreach ($object->images as $image) {
                    if (\Storage::disk('public')->exists('objects/' . $image->filename)) {
                        \Storage::disk('public')->copy(
                            '/objects/' . $image->filename,
                            Image::getDestinationPath() . $image->filename
                        );
                        $this->uploader->makeThumb(Image::getDestinationPath(), $image->filename, null, 140, true);
                    }
                }
                foreach ($object->infoparts as $infopart) {
                    foreach ($infopart->attachments as $attachment) {
                        if (\Storage::disk('public')->exists('objects/' . $attachment->filename)) {
                            \Storage::disk('public')->copy(
                                '/objects/' . $attachment->filename,
                                InfoPartAttachment::getDestinationPath() . $attachment->filename
                            );
                            if ($this->uploader->isImage(storage_path('app/public/' . InfoPartAttachment::getDestinationPath()) . $attachment->filename)) {
                                $this->uploader->makeThumb(InfoPartAttachment::getDestinationPath(), $attachment->filename, null, 140, true);
                            }
                        }
                    }
                }
                foreach ($object->persons as $person) {
                    if (!is_null($person->image)) {
                        if (\Storage::disk('public')->exists('objects/' . $person->image)) {
                            \Storage::disk('public')->copy(
                                '/objects/' . $person->image,
                                Person::getDestinationPath() . $person->image
                            );
                            $this->uploader->makeThumb(Person::getDestinationPath(), $person->image, 48, 48);
                        }
                    }
                }
            }
        }
        $objects = CObject::orderBy('code')->get();
        return view('objects.index', compact('objects'));
    }

    public function create()
    {
        return view('objects.create');
    }

    public function store(Request $request)
    {
        $object = $this->service->create($request);
        return redirect()->route('objects.show', $object->id);
    }

    public function edit($id)
    {
        $object = CObject::findOrFail($id);
        return view('objects.edit', compact('object'));
    }

    public function update($id, Request $request)
    {
        $object = $this->service->update($id, $request);
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
