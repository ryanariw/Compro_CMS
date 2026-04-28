@extends('profile.layouts.app')

@section('content')
@php
    $siteName = $setting->site_name ?? config('app.name', 'Company Profile');
@endphp

<header class="navbar">
    <div class="container navbar-inner">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-logo">
                @if (!empty($setting?->logo))
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $siteName }}">
                @else
                    {{ strtoupper(substr($siteName, 0, 1)) }}
                @endif
            </span>

            <span>{{ $siteName }}</span>
        </a>

        <nav class="nav-menu">
            <a href="#home">Home</a>
            <a href="#services">Services</a>
            <a href="#projects">Projects</a>
            <a href="#gallery">Gallery</a>
            <a href="#contact">Contact</a>
        </nav>

        <a href="{{ route('login') }}" class="btn btn-primary">Admin Login</a>
    </div>
</header>

<section class="hero" id="home">
    <div class="container hero-grid">
        <div>
            <span class="eyebrow">✦ Modern Company Profile</span>

            <h1 class="hero-title">
                Bangun citra perusahaan yang modern dan terpercaya.
            </h1>

            <p class="hero-desc">
                {{ $siteName }} hadir dengan layanan profesional untuk membantu bisnis tampil lebih rapi, kredibel, dan mudah dikenal pelanggan.
            </p>

            <div class="hero-actions">
                <a href="#services" class="btn btn-primary">Lihat Layanan</a>
                <a href="#contact" class="btn btn-white">Hubungi Kami</a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-panel">
                <div class="mini-dashboard">
                    <div class="mini-top">
                        <strong>Company Profile</strong>
                        <div class="mini-dot">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div class="mini-card">
                        <strong>{{ $services->count() }}+</strong>
                        <span>Layanan aktif yang siap ditampilkan ke pelanggan.</span>
                    </div>

                    <div class="mini-card">
                        <strong>{{ $projects->count() }}+</strong>
                        <span>Project dan portfolio perusahaan.</span>
                    </div>

                    <div class="mini-card">
                        <strong>{{ $galleries->count() }}+</strong>
                        <span>Gallery dokumentasi perusahaan.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Our Services</span>
            <h2>Layanan terbaik untuk mendukung kebutuhan bisnis.</h2>
            <p>Kami menghadirkan layanan yang dapat disesuaikan dengan kebutuhan perusahaan dan pelanggan.</p>
        </div>

        <div class="grid-3">
            @forelse($services as $service)
                <article class="card service-card">
                    <div class="icon-box">
                        {{ $service->icon ?? '✦' }}
                    </div>

                    <h3>{{ $service->title }}</h3>

                    <p>
                        {{ \Illuminate\Support\Str::limit($service->description ?? 'Deskripsi layanan belum tersedia.', 150) }}
                    </p>
                </article>
            @empty
                <article class="card service-card">
                    <div class="icon-box">✦</div>
                    <h3>Belum ada service</h3>
                    <p>Silakan tambahkan data service dari dashboard admin.</p>
                </article>
            @endforelse
        </div>
    </div>
</section>

<section class="section-white" id="projects">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Our Projects</span>
            <h2>Project dan portfolio yang pernah kami kerjakan.</h2>
            <p>Tampilkan hasil kerja terbaik agar calon pelanggan semakin percaya dengan perusahaan kamu.</p>
        </div>

        <div class="grid-3">
            @forelse($projects as $project)
                <article class="card">
                    @if($project->thumbnail)
                        <img src="{{ asset('storage/' . $project->thumbnail) }}"
                             alt="{{ $project->title }}"
                             class="project-img">
                    @else
                        <div class="project-img"></div>
                    @endif

                    <div class="card-body">
                        @if($project->client_name)
                            <span class="tag">{{ $project->client_name }}</span>
                        @endif

                        <h3>{{ $project->title }}</h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit($project->short_description ?? $project->description ?? 'Deskripsi project belum tersedia.', 135) }}
                        </p>
                    </div>
                </article>
            @empty
                <article class="card service-card">
                    <div class="icon-box">⌁</div>
                    <h3>Belum ada project</h3>
                    <p>Silakan tambahkan data project dari dashboard admin.</p>
                </article>
            @endforelse
        </div>
    </div>
</section>

<section id="gallery">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Gallery</span>
            <h2>Dokumentasi dan galeri perusahaan.</h2>
            <p>Bagikan momen, aktivitas, dan dokumentasi terbaik perusahaan kamu.</p>
        </div>

        <div class="grid-3">
            @forelse($galleries as $gallery)
                <article class="card">
                    @if($gallery->cover_image)
                        <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}" class="gallery-img">
                    @else
                        <div class="gallery-img"></div>
                    @endif

                    <div class="card-body">
                        <h3>{{ $gallery->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($gallery->description ?? 'Deskripsi gallery belum tersedia.', 125) }}</p>
                    </div>
                </article>
            @empty
                <article class="card service-card">
                    <div class="icon-box">◎</div>
                    <h3>Belum ada gallery</h3>
                    <p>Silakan tambahkan data gallery dari dashboard admin.</p>
                </article>
            @endforelse
        </div>
    </div>
</section>

<section class="contact-section" id="contact">
    <div class="container">
        <div class="contact-box">
            <div>
                <span class="eyebrow">Contact Us</span>

                <h2>Siap bekerja sama dengan kami?</h2>

                <p>
                    Hubungi kami untuk konsultasi, kerja sama, atau informasi lebih lanjut seputar layanan perusahaan.
                </p>

                <div class="socials">
                    @if(!empty($setting?->facebook))
                        <a href="{{ $setting->facebook }}" target="_blank">Facebook</a>
                    @endif

                    @if(!empty($setting?->instagram))
                        <a href="{{ $setting->instagram }}" target="_blank">Instagram</a>
                    @endif

                    @if(!empty($setting?->linkedin))
                        <a href="{{ $setting->linkedin }}" target="_blank">LinkedIn</a>
                    @endif

                    @if(!empty($setting?->youtube))
                        <a href="{{ $setting->youtube }}" target="_blank">YouTube</a>
                    @endif
                </div>
            </div>

            <div>
                <div class="contact-item">
                    <small>Email</small>
                    <span>{{ $setting->email ?? '-' }}</span>
                </div>

                <div class="contact-item">
                    <small>Phone</small>
                    <span>{{ $setting->phone ?? '-' }}</span>
                </div>

                <div class="contact-item">
                    <small>Address</small>
                    <span>{{ $setting->address ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container footer-inner">
        <div>
            <strong>{{ $siteName }}</strong>
            <div>Modern Company Profile Website</div>
        </div>

        <div>
            © {{ date('Y') }} {{ $siteName }}. All rights reserved.
        </div>
    </div>
</footer>
@endsection