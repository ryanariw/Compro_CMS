<?php
/* resources/views/products/index.blade.php */
?>
@extends('profile.layouts.app')

@section('content')
@php
    $siteName = 'GRC Classic Art';
@endphp

<style>
    section{ padding: 110px 0 80px; background: #FAF6EE; }
    .container{ max-width: 1100px; margin: 0 auto; padding: 0 20px; }
    .section-head{ text-align:center; margin-bottom: 30px; }
    .section-head h2{ font-size: 36px; color:#3B2A14; margin:0; }
    .section-head p{ color:#6B4C28; margin-top:10px; line-height:1.7; }
    .grid{ display:grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .card{
        background:#fff; border:1px solid rgba(201,168,76,.25);
        border-radius: 18px; overflow:hidden;
        box-shadow: 0 12px 40px rgba(15,23,42,.06);
        transition: .2s ease;
    }
    .card:hover{ transform: translateY(-4px); box-shadow: 0 18px 60px rgba(15,23,42,.10); }
    .thumb{ height: 180px; background: linear-gradient(135deg,#1A3222,#2E5038); display:flex; align-items:center; justify-content:center; }
    .thumb img{ width:100%; height:100%; object-fit:cover; }
    .card-body{ padding: 16px 16px 18px; }
    .tag{ display:inline-block; font-size: 11px; font-weight: 800; letter-spacing:1.5px; text-transform:uppercase; color:#8B6914; background: rgba(201,168,76,.12); padding:6px 10px; border-radius: 999px; margin-bottom: 10px; }
    .card-body h3{ margin:0; font-size: 16px; color:#3B2A14; line-height:1.3; }
    .card-body p{ margin: 10px 0 0; color:#6B4C28; font-size: 13px; line-height:1.7; }
    .card-body a{ display:inline-flex; margin-top: 12px; color:#C9A84C; font-weight:900; }
    @media(max-width: 900px){ .grid{ grid-template-columns: repeat(2, 1fr);} }
    @media(max-width: 640px){ .grid{ grid-template-columns: 1fr;} }
</style>

<section>
    <div class="container">
        <div class="section-head">
            <h2>Product GRC</h2>
            <p>Pilih produk yang Anda butuhkan. Detail spesifikasi (tabel diameter/satuan/harga) tersedia pada halaman produk.</p>
        </div>

        <div class="grid">
            @forelse($products as $product)
                <article class="card">
                    <div class="thumb">
                        @if($product->images->first())
                            <img src="{{ asset('storage/'.$product->images->first()->image) }}" alt="{{ $product->name }}">
                        @else
                            <span style="color: rgba(201,168,76,.5); font-weight:900;">✦</span>
                        @endif
                    </div>
                    <div class="card-body">
                        @if($product->category)
                            <span class="tag">{{ $product->category }}</span>
                        @endif
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->short_description ?? 'Spesifikasi produk tersedia pada halaman detail.' }}</p>
                        <a href="{{ route('products.show', $product->slug) }}">Lihat Detail →</a>
                    </div>
                </article>
            @empty
                <article class="card">
                    <div class="thumb" style="height:180px;">
                        <span style="color: rgba(201,168,76,.5); font-weight:900; font-size:42px;">✦</span>
                    </div>
                    <div class="card-body">
                        <h3>Produk belum tersedia</h3>
                        <p>Silakan tambahkan data produk dari dashboard admin.</p>
                    </div>
                </article>
            @endforelse
        </div>
    </div>
</section>
@endsection
