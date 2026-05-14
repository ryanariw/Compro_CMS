@extends('layouts.admin')

@section('title', 'Kelola Gambar – ' . $gallery->title)

@section('content')

{{-- ── Header ── --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0">📷 Gambar Gallery</h4>
        <p class="text-muted mb-0">{{ $gallery->title }}</p>
    </div>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary btn-sm">
        ← Kembali ke Daftar Gallery
    </a>
</div>

{{-- ── Alert ── --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ── Form Upload ── --}}
<div class="card mb-4">
    <div class="card-header pb-0">
        <h6>Upload Foto Baru</h6>
        <p class="text-sm text-muted mb-0">Format: JPG, JPEG, PNG, WEBP. Maks 3 MB per foto. Boleh pilih banyak sekaligus.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.galleries.images.store', $gallery) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-7">
                    <label class="form-label fw-semibold">Pilih Foto <span class="text-danger">*</span></label>
                    <input type="file"
                           name="images[]"
                           multiple
                           accept="image/jpeg,image/png,image/webp"
                           class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                           id="fileInput">
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="text-muted text-xs mt-1" id="fileCount"></div>
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-semibold">Judul / Keterangan <span class="text-muted">(opsional)</span></label>
                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           class="form-control"
                           placeholder="Contoh: Ruang Tamu Minimalis">
                </div>
            </div>

            {{-- Preview area --}}
            <div id="previewArea" class="row g-2 mt-2"></div>

            <div class="mt-3">
                <button type="submit" class="btn bg-gradient-primary">
                    ⬆ Upload Foto
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ── Daftar Foto ── --}}
<div class="card">
    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Foto Tersimpan <span class="badge bg-primary ms-1">{{ $images->count() }}</span></h6>
    </div>
    <div class="card-body">
        @if ($images->isEmpty())
            <div class="text-center py-5 text-muted">
                <p style="font-size:2rem;">🖼️</p>
                <p>Belum ada foto. Upload foto di atas.</p>
            </div>
        @else
            <div class="row g-3">
                @foreach ($images as $image)
                    <div class="col-6 col-md-3">
                        <div class="card h-100 shadow-sm">
                            {{-- Gambar --}}
                            <img src="{{ $image->image_url }}"
                                 alt="{{ $image->title ?? $gallery->title }}"
                                 class="card-img-top"
                                 style="height:160px; object-fit:cover;"
                                 onerror="this.src='https://placehold.co/400x300/eee/999?text=Foto+tidak+ditemukan'">

                            <div class="card-body p-2">
                                @if ($image->title)
                                    <p class="text-xs mb-1 fw-semibold">{{ $image->title }}</p>
                                @endif

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge {{ $image->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $image->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>

                                    <form action="{{ route('admin.galleries.images.destroy', $image) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus foto ini? Tindakan tidak bisa dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">
                                            🗑
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('fileInput').addEventListener('change', function () {
    const files = Array.from(this.files);
    const count = document.getElementById('fileCount');
    const preview = document.getElementById('previewArea');

    count.textContent = files.length > 0 ? files.length + ' foto dipilih' : '';
    preview.innerHTML = '';

    files.forEach(file => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = e => {
            const col = document.createElement('div');
            col.className = 'col-4 col-md-2';
            col.innerHTML = `<img src="${e.target.result}"
                                  style="width:100%;height:80px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">`;
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush