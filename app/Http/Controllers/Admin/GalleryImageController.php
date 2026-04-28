<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends Controller
{
    public function index(Gallery $gallery)
    {
        $gallery->load(['images' => function ($query) {
            $query->orderBy('sort_order')->latest();
        }]);

        return view('admin.galleries.images.index', compact('gallery'));
    }

    public function store(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'title' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        foreach ($request->file('images') as $image) {
            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'image' => $image->store('galleries/images', 'public'),
                'title' => $validated['title'] ?? null,
                'sort_order' => 0,
                'is_active' => $request->boolean('is_active', true),
            ]);
        }

        return redirect()
            ->route('admin.galleries.images.index', $gallery)
            ->with('success', 'Gambar gallery berhasil ditambahkan.');
    }

    public function destroy(GalleryImage $image)
    {
        $gallery = $image->gallery;

        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return redirect()
            ->route('admin.galleries.images.index', $gallery)
            ->with('success', 'Gambar berhasil dihapus.');
    }
}