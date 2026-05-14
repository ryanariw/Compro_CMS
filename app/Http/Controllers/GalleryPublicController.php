<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryPublicController extends Controller
{
    public function show(Gallery $gallery)
    {
        // Keep safe for inactive galleries
        if (isset($gallery->is_active) && !$gallery->is_active) {
            abort(404);
        }

        // Only show active images and keep consistent ordering for public view
        $gallery->loadMissing([
            'images' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
            }
        ]);

        return view('galleries.show', compact('gallery'));
    }
}
