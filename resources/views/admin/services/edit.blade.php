@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Edit Service</h6>
                <p class="text-sm mb-0">Perbarui data layanan perusahaan.</p>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $service->title) }}" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" rows="3" class="form-control">{{ old('short_description', $service->short_description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="6" class="form-control">{{ old('description', $service->description) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn bg-gradient-primary mb-0">Update</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary mb-0">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection