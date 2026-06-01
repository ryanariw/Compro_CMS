<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GalleryImage extends Model
{
    protected $fillable = [
        'gallery_id',
        'image',
        'title',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    /**
     * Normalisasi path file agar kompatibel dengan data lama maupun data upload baru.
     */
    public function getNormalizedImagePathAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        $path = trim($this->image);

        if ($path === '') {
            return null;
        }

        // Kalau tersimpan sebagai URL penuh, biarkan apa adanya.
        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        // Bersihkan prefix yang sering muncul pada data lama / import manual.
        $path = preg_replace('#^/?storage/#', '', $path);
        $path = preg_replace('#^/?public/#', '', $path);

        return ltrim($path, '/');
    }

    /**
     * URL file gambar publik untuk dipakai langsung di <img src="...">.
     * Menggunakan disk public agar konsisten dengan Storage::disk('public')->response().
     */
    public function getPublicImageSrcAttribute(): ?string
    {
        $path = $this->normalized_image_path;

        if (!$path) {
            Log::warning('GalleryImage public_image_src is null (normalized path empty).', [
                'image_field' => $this->image,
                'gallery_image_id' => $this->id,
                'gallery_id' => $this->gallery_id,
            ]);
            return null;
        }

        // Jika tersimpan berupa URL penuh, kembalikan apa adanya
        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            Log::info('GalleryImage public_image_src using full URL.', [
                'image_field' => $this->image,
                'normalized_path' => $path,
                'gallery_image_id' => $this->id,
            ]);
            return $path;
        }

        $url = Storage::disk('public')->url($path);

        Log::info('GalleryImage public_image_src resolved.', [
            'image_field' => $this->image,
            'normalized_path' => $path,
            'url' => $url,
            'gallery_image_id' => $this->id,
        ]);

        return $url;
    }

    /**
     * URL halaman detail gambar (route /galleries/images/{image}).
     */
    public function getImageUrlAttribute(): string
    {
        return route('galleries.images.show', $this);
    }
}
