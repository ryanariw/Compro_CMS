<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends Controller
{
    /**
     * Tampilkan daftar gambar + form upload untuk gallery tertentu.
     */
    public function index(Gallery $gallery)
    {
        $images = $gallery->images()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.galleries.images.index', compact('gallery', 'images'));
    }

    /**
     * Simpan satu atau banyak gambar ke storage & database.
     */
    public function store(Request $request, Gallery $gallery)
    {
        return response()->json([
            'hit' => true,
            'gallery_id' => $gallery->id,
            'has_images' => $request->hasFile('images'),
            'images_files_count' => is_array($request->file('images'))
                ? count($request->file('images'))
                : ($request->file('images') ? 1 : 0),
            'content_type' => $request->header('Content-Type'),
        ]);
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
