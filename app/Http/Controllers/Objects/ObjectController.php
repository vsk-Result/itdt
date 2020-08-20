<?php

namespace App\Http\Controllers\Objects;

use App\Models\Employees\Employee;
use App\Models\Icon;
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
        $this->middleware('permission:objects');
        $this->service = $service;
        $this->uploader = $uploader;
    }

    public function index()
    {
        return view('objects.index');
    }

    public function all(Request $request)
    {
        $objects = $request->is_active == 'true' ? CObject::active()->orderBy('code')->get() : CObject::orderBy('is_active', 'DESC')->orderBy('code')->get();
        $view_render = view('objects.list', compact('objects'))->render();
        return response()->json(compact('view_render'));
    }

    public function create()
    {
        $icons = Icon::all();
        $employees = Employee::pluck('fullname', 'id')->toArray();
        return view('objects.create', compact('icons', 'employees'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $object = $this->service->create($request);
        return redirect()->route('objects.show', $object->id);
    }

    public function edit($id)
    {
        $icons = Icon::all();
        $object = CObject::findOrFail($id);
        $employees = Employee::pluck('fullname', 'id')->toArray();
        return view('objects.edit', compact('object', 'icons', 'employees'));
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

    public function reorder(Request $request)
    {
        $order = $request->order;
        if (count($order) > 0) {
            $this->service->reorderInfoParts($order);
        }

        return response()->json([]);
    }

    public function word($id)
    {
        $object = CObject::findOrFail($id);

        $template_name = 'object_template.docx';
        $output_dir = 'app/public/temp_files/';
        $output_name = str_replace(' ', '_', $object->getFullName()) . '.docx';
        $output_path = $output_dir . $output_name;

        putenv('TMPDIR=' . public_path('/templates'));

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
