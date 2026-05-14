@extends('profile.layouts.app')

@section('content')
@php
    $siteName = 'GRC Classic Art';
@endphp

<style>
    section{ padding: 110px 0 90px; background:#FAF6EE; }
    .container{ max-width: 1100px; margin: 0 auto; padding: 0 20px; }
    .top-breadcrumb{
        color:#6B4C28; font-size:13px; font-weight:600; margin-bottom: 14px;
    }
    .product-hero{
        background:#fff;
        border: 1px solid rgba(201,168,76,.25);
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(15,23,42,.06);
        overflow:hidden;
    }
    .product-grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
    }
    .img-wrap{
        background: linear-gradient(135deg,#1A3222,#2E5038);
        min-height: 420px;
        display:flex;
        align-items:center;
        justify-content:center;
        padding: 20px;
    }
    .img-wrap img{ width:100%; height:100%; object-fit: contain; background:#fff; border-radius: 14px; padding: 10px; }
    .img-wrap .placeholder{ color: rgba(201,168,76,.6); font-weight:900; font-size:42px; }
    .content-wrap{ padding: 26px 24px; }
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
    .desc{ color:#6B4C28; line-height: 1.8; font-size: 14px; margin-top: 10px; }
    .table-wrap{
        margin-top: 22px;
        border-radius: 16px;
        overflow:hidden;
        border: 1px solid rgba(226,232,240,.9);
    }
    table{ width:100%; border-collapse: collapse; background:#fff; }
    th, td{
        padding: 14px 14px;
        border-bottom: 1px solid rgba(226,232,240,.9);
        text-align:center;
        font-size: 14px;
    }
    th{
        background: rgba(201,168,76,.10);
        color:#3B2A14;
        font-weight: 900;
    }
    td{ color:#4A3520; }
    .footer-cta{
        margin-top: 22px;
        display:flex;
        gap: 14px;
        flex-wrap: wrap;
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
        background: #22c55e;
        border-color: #22c55e;
        color:#fff;
    }

    @media(max-width: 900px){
        .product-grid{ grid-template-columns: 1fr; }
        .img-wrap{ min-height: 320px; }
        h1{ font-size: 32px; }
    }
</style>

<section>
    <div class="container">
        <div class="top-breadcrumb">
            <a href="{{ route('home') }}" style="color:#8B6914; font-weight:900;">Home</a>
            &nbsp;/&nbsp;
            <a href="{{ route('products.index') }}" style="color:#8B6914; font-weight:900;">Products</a>
        </div>

        <div class="product-hero">
            <div class="product-grid">
                <div class="img-wrap">
                    @if($product->images->count())
                        <div style="width:100%; display:grid; grid-template-columns: repeat(2, 1fr); gap:10px;">
                            @foreach($product->images as $img)
                                <div style="background:#fff; border-radius:14px; padding:10px; border:1px solid rgba(226,232,240,.9);">
                                    <img src="{{ asset('storage/'.$img->image) }}" alt="{{ $product->name }}" style="width:100%; height:220px; object-fit:cover; border-radius:10px;">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="placeholder">✦</div>
                    @endif
                </div>

                <div class="content-wrap">
                    @if($product->category)
                        <div class="tag">{{ $product->category }}</div>
                    @endif

                    <h1>{{ $product->name }}</h1>

                    @if($product->short_description)
                        <div class="desc">{{ $product->short_description }}</div>
                    @elseif($product->description)
                        <div class="desc">{{ $product->description }}</div>
                    @endif

                    @php
                        $specs = $product->specs ?? [];

                        // Fallback kalau specs tersimpan sebagai JSON string
                        if (is_string($specs)) {
                            $decoded = json_decode($specs, true);
                            $specs = is_array($decoded) ? $decoded : [];
                        }

                        // Pastikan numeric array
                        if (is_array($specs) && array_keys($specs) !== range(0, count($specs) - 1)) {
                            $specs = array_values($specs);
                        }

                        $parseSpecVal = function ($val) {
                            if (!is_string($val)) {
                                return ['', 'Pcs', ''];
                            }

                            $val = trim($val);

                            // Expected: "Diameter | Satuan | Harga"
                            $parts = preg_split('/\s*\|\s*/', $val);
                            if (count($parts) >= 3) {
                                return [
                                    trim($parts[0] ?? ''),
                                    trim($parts[1] ?? '') !== '' ? trim($parts[1]) : 'Pcs',
                                    trim($parts[2] ?? ''),
                                ];
                            }

                            // Fallback: "Diameter - Satuan - Harga"
                            $parts = preg_split('/\s*-\s*/', $val);
                            if (count($parts) >= 3) {
                                return [
                                    trim($parts[0] ?? ''),
                                    trim($parts[1] ?? '') !== '' ? trim($parts[1]) : 'Pcs',
                                    trim($parts[2] ?? ''),
                                ];
                            }

                            // Last resort
                            return [$val, 'Pcs', ''];
                        };

                        $normalizeSpecVal = function ($spec) {
                            // spec bisa array/object/string
                            if (is_string($spec)) {
                                return $spec;
                            }

                            if (is_array($spec)) {
                                return $spec['val'] ?? $spec['value'] ?? $spec['spec'] ?? '';
                            }

                            if (is_object($spec)) {
                                $arr = (array) $spec;
                                return $arr['val'] ?? $arr['value'] ?? $arr['spec'] ?? '';
                            }

                            return '';
                        };
                    @endphp

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Diameter</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $renderedAny = false;
                                @endphp

                                @if(is_array($specs) && count($specs))
                                    @foreach($specs as $spec)
                                        @php
                                            $val = $normalizeSpecVal($spec);
                                            [$diameter, $satuan, $harga] = $parseSpecVal($val);

                                            $isValidRow = (trim($diameter) !== '' || trim($harga) !== '' || trim($satuan) !== '');
                                        @endphp

                                        @if($isValidRow)
                                            @php $renderedAny = true; @endphp
                                            <tr>
                                                <td>{{ $diameter }}</td>
                                                <td>{{ $satuan }}</td>
                                                <td>{{ $harga !== '' ? $harga : $val }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                @if(!$renderedAny)
                                    <tr>
                                        <td colspan="3" style="color:#6B4C28; font-weight:800; background:#FAF6EE;">
                                            Spesifikasi belum tersedia.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="footer-cta">
                        <a href="{{ url('https://wa.me/6285156932212?text=' . urlencode('Halo, saya ingin tanya harga untuk produk ' . $product->name . '. Terima kasih.')) }}" class="btn btn-primary" target="_blank" rel="noopener">
                            💬 Info Produk dan Harga
                        </a>
                        <a href="{{ route('products.index') }}" class="btn">
                            ← Kembali ke Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
