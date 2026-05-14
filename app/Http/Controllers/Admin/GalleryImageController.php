<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends Controller
{
    /**
     * Tampilkan daftar gambar + form upload untuk gallery tertentu.
     */
    public function index(Gallery $gallery)
    {
        $images = $gallery->images()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.galleries.images.index', compact('gallery', 'images'));
    }

    /**
     * Simpan satu atau banyak gambar ke storage & database.
     */
    public function store(Request $request, Gallery $gallery)
    {
        $request->validate([
            'images'    => ['required', 'array', 'min:1'],
            'images.*'  => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'title'     => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($request->file('images') as $file) {
            // Simpan ke storage/app/public/galleries/images/
            $path = $file->store('galleries/images', 'public');

            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'image'      => $path,
                'title'      => $request->input('title'),
                'sort_order' => 0,
                'is_active'  => true,
            ]);
        }

        return redirect()
            ->route('admin.galleries.images.index', $gallery)
            ->with('success', count($request->file('images')) . ' gambar berhasil diupload.');
    }

    /**
     * Hapus satu gambar dari storage & database.
     */
    public function destroy(GalleryImage $image)
    {
        $gallery = $image->gallery;

        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return redirect()
            ->route('admin.galleries.images.index', $gallery)
            ->with('success', 'Gambar berhasil dihapus.');
    }
}