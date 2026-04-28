@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('admin.projects.index') }}" class="card border shadow-none h-100 text-decoration-none">
            <div class="card-body">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md mb-3">
                    <i class="ni ni-tv-2 text-white text-sm"></i>
                </div>
                <h6 class="text-dark mb-1">Kelola Projects</h6>
                <p class="text-sm text-secondary mb-0">Atur portofolio dan project perusahaan.</p>
            </div>
        </a>
    </div>
    <!-- card Gallery dan Settings -->
</div>
@endsection