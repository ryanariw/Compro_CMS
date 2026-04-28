@extends('layouts.admin')

@section('title', 'Galleries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Galleries</h4>
    <a href="{{ route('admin.galleries.create') }}" class="btn bg-gradient-primary">Tambah Gallery</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Total Images</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($galleries as $gallery)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                @if($gallery->cover_image)
                                    <img src="{{ asset('storage/' . $gallery->cover_image) }}"
                                         alt="{{ $gallery->title }}"
                                         width="80"
                                         class="rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $gallery->title }}</strong>
                                <br>
                                <small class="text-muted">{{ $gallery->slug }}</small>
                            </td>

                            <td>{{ $gallery->images_count }}</td>

                            <td class="text-center">
                                @if($gallery->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.galleries.images.index', $gallery->id) }}"
                                   class="btn btn-sm btn-outline-info">
                                    Images
                                </a>

                                <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus gallery ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada data gallery.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $galleries->links() }}
</div>
@endsection