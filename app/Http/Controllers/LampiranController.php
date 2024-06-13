<?php

namespace App\Http\Controllers;

class LampiranController extends Controller
{

    public function view(String $file)
    {
        $storage = \Storage::disk('upload');
        $fullpath = 'lampiran/' . $file;

        $mime = class_exists('finfo') ? $storage->mimeType($fullpath) : 'Image/PNG';

        if (!$storage->exists($fullpath)) {
            $file = $storage->get('wajah/not-found.jpg');
        } else {
            $file = $storage->get($fullpath);
        }

        $response = \Response::make($file, 200);
        $response->header('Content-type', $mime);

        return $response;
    }
}
