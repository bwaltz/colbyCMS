<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Plank\Mediable\Media;
use MediaUploader;

class MediaController extends Controller
{

    public function upload(Request $request)
    {
        $media = MediaUploader::fromSource($request->file('file')->path())->toDirectory('uploads')->upload();
        return response()->json(['link' => '/storage/uploads/'.$media->filename.'.'.$media->extension]);
    }

    public function index()
    {
        return response()->json(Media::inDirectory('public', 'uploads')->get());
    }

    public function store(Request $request)
    {
        $returnFiles = [];
        foreach($request->file('files') as $file) {
            $media = MediaUploader::fromSource($file->path())->toDirectory('uploads')->upload();
            $returnFiles[] = ['link' => '/storage/uploads/'.$media->filename.'.'.$media->extension];
        }
        return response()->json(['files' => $returnFiles], 200);
    }

    public function show(Page $page)
    {
        // return a single instance of a post in JSON
        return new PageResource($page);
    }
}
