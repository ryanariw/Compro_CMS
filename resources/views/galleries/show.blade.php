@extends('profile.layouts.app')

@section('content')
@php
    $siteName = 'GRC Classic Art';

    $coverSrc = null;
    $coverPath = $gallery->cover_image;

    if ($coverPath) {
        $coverPath = trim($coverPath);

        if (\Illuminate\Support\Str::startsWith($coverPath, ['http://', 'https://', '//'])) {
            $coverSrc = $coverPath;
        } else {
            $coverPath = preg_replace('#^/?storage/#', '', $coverPath);
            $coverPath = preg_replace('#^/?public/#', '', $coverPath);
            $coverPath = ltrim($coverPath, '/');

            $coverSrc = asset('storage/' . $coverPath);
        }
    }
@endphp

<style>
    section{ padding: 110px 0 90px; background:#FAF6EE; }
    .container{ max-width: 1100px; margin: 0 auto; padding: 0 20px; }

    .gallery-hero{
        background:#fff;
        border: 1px solid rgba(201,168,76,.25);
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(15,23,42,.06);
        overflow:hidden;
    }

    .gallery-grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
    }

    .left-wrap{
        padding: 26px;
    }

    .right-wrap{
        padding: 26px 24px;
        border-left: 1px solid rgba(226,232,240,.9);
        background:#fff;
    }

    .tag{
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

    h1{
        margin: 8px 0 8px;
        font-size: 40px;
        color:#3B2A14;
        line-height: 1.1;
        font-family: 'Playfair Display', serif;
    }

    .sub{
        margin-top: 10px;
        color:#6B4C28;
        font-weight: 700;
        font-size: 14px;
        line-height: 1.8;
    }

    .images-grid{
        display:grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .img-card{
        border: 1px solid rgba(226,232,240,.9);
        border-radius: 18px;
        background:#fff;
        overflow:hidden;
        box-shadow: 0 8px 24px rgba(15,23,42,.04);
    }

    .img-card a{
        display:block;
        text-decoration:none;
        color:inherit;
    }

    .img-card img{
        width:100%;
        height: 210px;
        object-fit: cover;
        display:block;
        background:#FAF6EE;
    }

    .img-caption{
        padding: 12px 14px;
        font-size: 12px;
        color:#6B4C28;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .empty-state{
        width:100%;
        min-height: 280px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        padding: 24px;
        color:#8B6914;
        font-weight: 700;
        background: linear-gradient(135deg,#FCFAF5,#F5EEDC);
        border-radius: 18px;
        border: 1px dashed rgba(201,168,76,.35);
    }

    .footer-cta{
        padding: 0 26px 26px;
        display:flex;
        gap: 14px;
        flex-wrap: wrap;
        align-items:center;
    }

    .btn{
        display:inline-flex; align-items:center; justify-content:center;
        padding: 14px 18px;
        border-radius: 12px;
        font-weight: 900;
        border: 1px solid rgba(201,168,76,.35);
        background: #fff;
        color:#3B2A14;
        text-decoration:none;
    }

    .btn-primary{
        background: #1A3222;
        border-color: rgba(26,50,34,.8);
        color:#fff;
    }

    @media(max-width: 900px){
        .gallery-grid{ grid-template-columns: 1fr; }
        .right-wrap{ border-left: 0; border-top: 1px solid rgba(226,232,240,.9); }
        h1{ font-size: 32px; }
        .images-grid{ grid-template-columns: 1fr; }
    }
</style>

<section>
    <div class="container">
        <div class="gallery-hero">
            <div class="gallery-grid">
                <div class="left-wrap">
                    <div class="images-grid">
                       @if($coverSrc)
                            <div class="img-card" style="grid-column:1 / -1;">
                                <a href="{{ $coverSrc }}" target="_blank" rel="noopener">
                                    <img src="{{ $coverSrc }}"
                                        alt="{{ $gallery->title }}"
                                        loading="lazy"
                                        style="height:420px;">
                                </a>

                                <div class="img-caption">
                                    {{ $gallery->title }}
                                </div>
                            </div>
                        @else
                            <div class="img-card" style="grid-column:1 / -1; border:none; box-shadow:none;">
                                <div class="empty-state">
                                    Foto gallery belum tersedia.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="right-wrap">
                    <div class="tag">Gallery</div>
                    <h1>{{ $gallery->title }}</h1>

                <div class="sub">
                {{ $siteName }}
                    </div>

                    <div class="sub">
                        {{ $gallery->description ?? 'Tidak ada deskripsi untuk gallery ini.' }}
                    </div>
                </div>
            </div>

            <div class="footer-cta">
                <a href="{{ url()->previous() }}" class="btn">← Kembali</a>
                <a href="{{ route('home') }}#gallery" class="btn btn-primary">Lihat Gallery Lain</a>
            </div>
        </div>
    </div>
</section>
@endsection
