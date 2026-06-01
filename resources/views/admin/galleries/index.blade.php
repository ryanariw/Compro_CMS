@extends('layouts.admin')

@section('title', 'Kelola Gallery')

@section('content')

<div class="mb-4">
    <div class="d-flex flex-column flex-md-row gap-2 justify-content-between align-items-md-center">
        <div>
            <h4 class="mb-0">📚 Kelola Gallery</h4>
            <p class="text-muted mb-0">Tambah, edit, dan kelola foto pada setiap gallery.</p>
        </div>

        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm w-100 w-md-auto">
            + Tambah Gallery
        </a>
    </div>
</div>

@if (session('success'))tab
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

<div class="card">
    <div class="card-header pb-0 d-flex flex-column flex-sm-row gap-2 justify-content-between align-items-sm-center">
        <h6 class="mb-0">Daftar Gallery</h6>
        <span class="badge bg-primary ms-1">{{ $galleries->total() }}</span>
    </div>

    <div class="card-body">
        @if ($galleries->isEmpty())
            <div class="text-center py-5 text-muted">
                <p style="font-size:2rem;">📷</p>
                <p>Belum ada gallery.</p>
            </div>
        @else
            {{-- table di mobile biar bisa scroll horizontal --}}
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Judul</th>
                            <th class="text-nowrap">Slug</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-end text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $gallery->title }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $gallery->slug }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $gallery->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                    <div class="text-muted small mt-1">
                                        Total Foto: {{ $gallery->images_count ?? 0 }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    {{-- aksi stack di mobile --}}
                                    <div class="d-flex flex-column flex-md-row gap-2 align-items-md-end align-items-stretch">
                                        <a href="{{ route('admin.galleries.edit', $gallery) }}"
                                           class="btn btn-outline-secondary btn-sm w-100 w-md-auto">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.galleries.destroy', $gallery) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus gallery ini? Termasuk semua foto di dalamnya.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100 w-md-auto">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
