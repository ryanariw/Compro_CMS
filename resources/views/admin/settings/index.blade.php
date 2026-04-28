@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Settings Company Profile</h4>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h6 class="mb-3">Informasi Website</h6>

            <div class="mb-3">
                <label class="form-label">Nama Website / Perusahaan</label>
                <input type="text"
                       name="site_name"
                       value="{{ old('site_name', $setting->site_name ?? '') }}"
                       class="form-control @error('site_name') is-invalid @enderror">

                @error('site_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Logo</label>
                <input type="file"
                       name="logo"
                       class="form-control @error('logo') is-invalid @enderror">

                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if (!empty($setting?->logo))
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $setting->logo) }}"
                             alt="Logo"
                             width="160"
                             class="rounded">
                    </div>
                @endif
            </div>

            <hr>

            <h6 class="mb-3">Kontak</h6>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', $setting->email ?? '') }}"
                           class="form-control @error('email') is-invalid @enderror">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone / WhatsApp</label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $setting->phone ?? '') }}"
                           class="form-control @error('phone') is-invalid @enderror">

                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address"
                          rows="4"
                          class="form-control @error('address') is-invalid @enderror">{{ old('address', $setting->address ?? '') }}</textarea>

                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <h6 class="mb-3">Social Media</h6>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Facebook</label>
                    <input type="url"
                           name="facebook"
                           value="{{ old('facebook', $setting->facebook ?? '') }}"
                           class="form-control @error('facebook') is-invalid @enderror"
                           placeholder="https://facebook.com/...">

                    @error('facebook')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Instagram</label>
                    <input type="url"
                           name="instagram"
                           value="{{ old('instagram', $setting->instagram ?? '') }}"
                           class="form-control @error('instagram') is-invalid @enderror"
                           placeholder="https://instagram.com/...">

                    @error('instagram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">LinkedIn</label>
                    <input type="url"
                           name="linkedin"
                           value="{{ old('linkedin', $setting->linkedin ?? '') }}"
                           class="form-control @error('linkedin') is-invalid @enderror"
                           placeholder="https://linkedin.com/...">

                    @error('linkedin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">YouTube</label>
                    <input type="url"
                           name="youtube"
                           value="{{ old('youtube', $setting->youtube ?? '') }}"
                           class="form-control @error('youtube') is-invalid @enderror"
                           placeholder="https://youtube.com/...">

                    @error('youtube')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn bg-gradient-primary">
                Simpan Settings
            </button>
        </form>
    </div>
</div>
@endsection