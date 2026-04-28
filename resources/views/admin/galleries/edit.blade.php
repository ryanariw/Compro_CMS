@extends('layouts.admin')

@section('title', 'Edit Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Gallery</h4>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul Gallery</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $gallery->title) }}"
                       class="form-control @error('title') is-invalid @enderror">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Cover Image</label>
                <input type="file"
                       name="cover_image"
                       class="form-control @error('cover_image') is-invalid @enderror">

                @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if($gallery->cover_image)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $gallery->cover_image) }}"
                             alt="{{ $gallery->title }}"
                             width="180"
                             class="rounded">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description"
                          rows="5"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $gallery->description) }}</textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-4">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       class="form-check-input"
                       id="is_active"
                       {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>

                <label for="is_active" class="form-check-label">
                    Active
                </label>
            </div>

            <button type="submit" class="btn bg-gradient-primary">
                Update
            </button>
        </form>
    </div>
</div>
@endsection