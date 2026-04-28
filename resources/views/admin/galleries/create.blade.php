@extends('layouts.admin')

@section('title', 'Tambah Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Tambah Gallery</h4>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Gallery</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
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
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description"
                          rows="5"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

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
                       checked>

                <label for="is_active" class="form-check-label">
                    Active
                </label>
            </div>

            <button type="submit" class="btn bg-gradient-primary">
                Simpan
            </button>
        </form>
    </div>
</div>
@endsection