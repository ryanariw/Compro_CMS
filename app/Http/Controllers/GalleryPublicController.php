<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryPublicController extends Controller
{
    public function show(Gallery $gallery)
    {
        if (isset($gallery->is_active) && !$gallery->is_active) {
            abort(404);
        }

        return view('galleries.show', compact('gallery'));
    }
}