@extends('profile.layouts.app')

@section('content')
@php
    $siteName = 'GRC Classic Art';
@endphp

<style>
    section{ padding: 110px 0 90px; background:#FAF6EE; }
    .container{ max-width: 1100px; margin: 0 auto; padding: 0 20px; }

    .hero{
        background:#fff;
        border: 1px solid rgba(201,168,76,.25);
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(15,23,42,.06);
        overflow:hidden;
    }

    .gallery-grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        padding: 22px;
    }

    .gallery-main{
        padding: 18px;
        border-right: 1px solid rgba(226,232,240,.9);
    }

    .gallery-title{
        font-size: 28px;
        color:#3B2A14;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .gallery-desc{
        color:#6B4C28;
        line-height: 1.8;
        font-size: 14px;
        margin-bottom: 16px;
    }

    .gallery-badge{
        display:inline-block;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color:#8B6914;
        background: rgba(201,168,76,.12);
        padding: 6px 12px;
        border-radius: 999px;
        margin-bottom: 12px;
    }

    .images{
        padding: 18px;
    }

    .images-grid{
        display:grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .img-card{
        border: 1px solid rgba(226,232,240,.9);
        border-radius: 16px;
        background:#fff;
        overflow:hidden;
    }
    .img-card img{
        width:100%;
        height: 180px;
        object-fit: cover;
        display:block;
        background:#FAF6EE;
    }
    .img-caption{
        padding: 10px 12px;
        font-size: 12px;
        color:#6B4C28;
        font-weight: 600;
    }

    .footer-cta{
        padding: 0 22px 22px;
        display:flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .btn{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding: 14px 18px;
        border-radius: 12px;
        border: 1px solid rgba(201,168,76,.35);
        background:#fff;
        color:#3B2A14;
        text-decoration:none;
        font-weight: 800;
        font-size: 14px;
    }

    .btn-primary{
        background: #1A3222;
        border-color: rgba(26,50,34,.8);
        color: #fff;
    }

    @media (max-width: 900px){
        .gallery-grid{ grid-template-columns: 1fr; }
        .gallery-main{ border-right: 0; border-bottom: 1px solid rgba(226,232,240,.9); }
    }
</style>

<section>
    <div class="container">
        <div class="hero">
            <div class="gallery-grid">
                <div class="gallery-main">
                    <div class="gallery-badge">Gallery Detail</div>
                    <div class="gallery-title">{{ $gallery->title }}</div>
                    <div class="gallery-desc">{{ $gallery->description ?? 'Deskripsi gallery belum tersedia.' }}</div>

                    <div style="color:#6B4C28;font-weight:700;font-size:13px;">
                        Total Foto: {{ $gallery->images?->count() ?? 0 }}
                    </div>
                </div>

                <div class="images">
                    <div class="images-grid">
                        @forelse($gallery->images as $image)
                            <div class="img-card">
                                @php
                                    $imagePath = $image->image ? asset('storage/' . $image->image) : null;
                                @endphp

                                @if($imagePath)
                                    <img src="{{ $imagePath }}"
                                         alt="{{ $image->title ?? $gallery->title }}"
                                         loading="lazy"
                                         onerror="this.style.display='none';">
                                @endif

                                @if(!empty($image->title))
                                    <div class="img-caption">{{ $image->title }}</div>
                                @elseif(empty($image->title))
                                    <div class="img-caption" style="opacity:.65;">(Tanpa judul)</div>
                                @endif
                            </div>
                        @empty
                            <div class="img-card" style="grid-column:1 / -1;">
                                <div class="img-caption">Belum ada foto untuk gallery ini.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="footer-cta">
                <a href="{{ url()->previous() }}" class="btn">← Kembali</a>
            </div>
        </div>
    </div>
</section>
@endsection
