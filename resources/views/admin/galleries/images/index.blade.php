@extends('layouts.admin')

@section('title', 'Gallery Images')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4>Images: {{ $gallery->title }}</h4>
        <p class="text-muted mb-0">Kelola gambar dalam gallery ini.</p>
    </div>

    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.galleries.images.store', $gallery->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Upload Images</label>
                <input type="file"
                       name="images[]"
                       multiple
                       class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">

                @error('images')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @error('images.*')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Gambar</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Opsional">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-4">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       class="form-check-input"
                       id="is_active"
                       checked>

                <label for="is_active" class="form-check-label">
                    Active
                </label>
            </div>

            <button type="submit" class="btn bg-gradient-primary">
                Upload
            </button>
        </form>
    </div>
</div>

<div class="row">
    @forelse($gallery->images as $image)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $image->image) }}"
                     class="card-img-top"
                     alt="{{ $image->title }}"
                     style="height: 180px; object-fit: cover;">

                <div class="card-body">
                    <h6 class="mb-2">
                        {{ $image->title ?? 'No Title' }}
                    </h6>

                    <div class="mb-3">
                        @if($image->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </div>

                    <form action="{{ route('admin.galleries.images.destroy', $image->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin hapus gambar ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center text-muted">
                    Belum ada gambar di gallery ini.
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection