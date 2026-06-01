<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;

class GalleryImagePublicController extends Controller
{
    public function show(GalleryImage $image)
    {
        $gallery = $image->gallery;

        if (
            !$gallery
            || (isset($gallery->is_active) && !$gallery->is_active)
            || (isset($image->is_active) && !$image->is_active)
        ) {
            abort(404);
        }

        return $this->renderImage($image);
    }

    public function preview(GalleryImage $image)
    {
        return $this->renderImage($image);
    }

    private function renderImage(GalleryImage $image)
    {
        $path = $image->normalized_image_path;

        if (!$path) {
            abort(404);
        }

        if (preg_match('#^(https?:)?//#i', $path)) {
            return redirect()->away($path);
        }

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->response($path);
    }
}
