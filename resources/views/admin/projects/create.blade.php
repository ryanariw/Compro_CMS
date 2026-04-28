@extends('layouts.admin')

@section('title', 'Tambah Project')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Tambah Project</h4>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Project</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Masukkan judul project">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Client</label>
                <input type="text"
                       name="client_name"
                       value="{{ old('client_name') }}"
                       class="form-control @error('client_name') is-invalid @enderror"
                       placeholder="Contoh: PT Maju Bersama">

                @error('client_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Thumbnail Project</label>
                <input type="file"
                       name="thumbnail"
                       class="form-control @error('thumbnail') is-invalid @enderror">

                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Format: jpg, jpeg, png, webp. Maksimal 2MB.
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="short_description"
                          rows="3"
                          class="form-control @error('short_description') is-invalid @enderror"
                          placeholder="Tulis ringkasan singkat project">{{ old('short_description') }}</textarea>

                @error('short_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Lengkap</label>
                <textarea name="description"
                          rows="6"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Tulis detail project">{{ old('description') }}</textarea>

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
                       {{ old('is_active', true) ? 'checked' : '' }}>

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