@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Project</h4>

    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul Project</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $project->title) }}"
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
                       value="{{ old('client_name', $project->client_name) }}"
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
                    Kosongkan jika tidak ingin mengganti thumbnail. Format: jpg, jpeg, png, webp. Maksimal 2MB.
                </small>

                @if($project->thumbnail)
                    <div class="mt-3">
                        <p class="mb-2 text-sm text-muted">Thumbnail saat ini:</p>
                        <img src="{{ asset('storage/' . $project->thumbnail) }}"
                             alt="{{ $project->title }}"
                             width="180"
                             class="rounded"
                             style="object-fit: cover;">
                    </div>
                @else
                    <div class="mt-2">
                        <span class="text-muted">Belum ada thumbnail.</span>
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="short_description"
                          rows="3"
                          class="form-control @error('short_description') is-invalid @enderror"
                          placeholder="Tulis ringkasan singkat project">{{ old('short_description', $project->short_description) }}</textarea>

                @error('short_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Lengkap</label>
                <textarea name="description"
                          rows="6"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Tulis detail project">{{ old('description', $project->description) }}</textarea>

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
                       {{ old('is_active', $project->is_active) ? 'checked' : '' }}>

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