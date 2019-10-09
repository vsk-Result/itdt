<?php

namespace App\UseCases\Objects;

use Illuminate\Http\Request;
use App\Models\Objects\Person;
use App\Services\Upload\Uploader;
use Illuminate\Support\Facades\DB;

class PersonService
{
    private $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function create($object_id, $index, Request $request): Person
    {
        return DB::transaction(function () use ($object_id, $index, $request) {

            $person = Person::make([
                'object_id' => $object_id,
                'fullname' => $request->fullname[$index],
                'appointment' => isset($request->appointment) ? $request->appointment[$index] : '',
                'phone' => isset($request->phone) ? $request->phone[$index] : '',
                'email' => isset($request->email) ? $request->email[$index] : '',
                'link' => isset($request->link) ? $request->link[$index] : '',
            ]);
            $person->saveOrFail();

            $this->updateImage($person->id, $request->file('avatar_' . $index));

            return $person;
        });
    }

    public function update($object_id, $index, Request $request): Person
    {
        return DB::transaction(function () use ($object_id, $index, $request) {

            $person = $this->getPerson($request->p_id[$index]);
            $person->update([
                'object_id' => $object_id,
                'fullname' => $request->fullname[$index],
                'appointment' => isset($request->appointment) ? $request->appointment[$index] : '',
                'phone' => isset($request->phone) ? $request->phone[$index] : '',
                'email' => isset($request->email) ? $request->email[$index] : '',
                'link' => isset($request->link) ? $request->link[$index] : '',
            ]);

            $this->updateImage($person->id, $request->file('avatar_' . $index));

            return $person;
        });
    }

    public function updateImage($id, $image)
    {
        $person = $this->getPerson($id);

        $filename = $this->uploader->upload(
            $image,
            Person::getDestinationPath()
        );

        if (!is_null($filename)) {
            $person->update([
                'image' => $filename
            ]);
        }

        return $person;
    }

    public function destroy($ids)
    {
        Person::whereIn('id', $ids)->delete();
    }

    public function getPerson($id): Person
    {
        return Person::findOrFail($id);
    }
}