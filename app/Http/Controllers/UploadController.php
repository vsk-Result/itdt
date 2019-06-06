<?php

namespace App\Http\Controllers;

use App\Services\Upload\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UploadController extends Controller
{
    private $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }
    public function store(Request $request)
    {
        $filename = $this->uploader->upload(
            $request->file('file'),
            $request->path
        );
        $link = config('app.url') . '/storage/' . $request->path . '/' . $filename;
        return response()->json(compact('link', 'filename'));
    }
}
