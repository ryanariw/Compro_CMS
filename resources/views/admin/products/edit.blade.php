<?php
?>
@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Edit Product</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-light">← Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="product-form" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Short Description</label>
                <input type="text" name="short_description" class="form-control" value="{{ old('short_description', $product->short_description) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Aktif</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ $product->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
            </div>

            @php
                $specs = is_array($product->specs) ? $product->specs : [];
                $diamArr = [];
                $satArr = [];
                $hargaArr = [];

                $parseVal = function ($val) {
                    if (!is_string($val)) return ['', 'Pcs', ''];

                    $val = trim($val);

                    // Primary: "Diameter | Satuan | Harga"
                    $parts = preg_split('/\s*\|\s*/', $val);
                    if (count($parts) >= 3) {
                        return [
                            trim($parts[0]),
                            trim($parts[1]) !== '' ? trim($parts[1]) : 'Pcs',
                            trim($parts[2]),
                        ];
                    }

                    // Fallback: try '-' delimiter "Diameter - Satuan - Harga"
                    $parts = preg_split('/\s*-\s*/', $val);
                    if (count($parts) >= 3) {
                        return [
                            trim($parts[0]),
                            trim($parts[1]) !== '' ? trim($parts[1]) : 'Pcs',
                            trim($parts[2]),
                        ];
                    }

                    // Last resort: if not parseable, show full val into diameter so it doesn't look empty
                    return [$val, 'Pcs', ''];
                };

                foreach ($specs as $spec) {
                    $val = $spec['val'] ?? '';
                    [$diam, $sat, $harga] = $parseVal($val);
                    $diamArr[] = $diam;
                    $satArr[] = $sat;
                    $hargaArr[] = $harga;
                }

                if (count($diamArr) === 0) {
                    $diamArr = [''];
                    $satArr = ['Pcs'];
                    $hargaArr = [''];
                }
            @endphp

            <div class="col-12">
                <hr>
                <h5 class="mb-3">Spesifikasi Tabel (seperti foto)</h5>

                <div class="table-responsive">
                    <table class="table align-middle" id="spec-table">
                        <thead>
                            <tr>
                                <th>Diameter</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th style="width:90px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diamArr as $i => $diam)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="spec_diameters[]" value="{{ old("spec_diameters.$i", $diam) }}" placeholder="40 Cm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="spec_satuans[]" value="{{ old("spec_satuans.$i", $satArr[$i] ?? 'Pcs') }}" placeholder="Pcs">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="spec_hargas[]" value="{{ old("spec_hargas.$i", $hargaArr[$i] ?? '') }}" placeholder="Rp 650.000">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="spec-hidden"></div>

                <button type="button" class="btn btn-outline-primary btn-sm" onclick="addRow()">+ Tambah Baris</button>
                <div class="form-text mt-2">Format penyimpanan: "Diameter | Satuan | Harga".</div>
            </div>

            <div class="col-12">
                <hr>
                <h5 class="mb-3">Tambah Gambar (opsional)</h5>
                <div class="mb-2">
                    <input type="file" name="images[]" class="form-control" multiple>
                    <div class="form-text mt-2">
                        Jika upload foto baru: harus <strong>tepat 5 foto</strong> (maks 5) dan setiap foto <strong>minimal 7MB</strong>.
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

        <script>
            function addRow() {
                const tbody = document.querySelector('#spec-table tbody');
                const firstRow = tbody.children[0];
                const row = firstRow.cloneNode(true);

                row.querySelector('input[name="spec_diameters[]"]').value = '';
                row.querySelector('input[name="spec_satuans[]"]').value = 'Pcs';
                row.querySelector('input[name="spec_hargas[]"]').value = '';
                row.querySelector('button').onclick = function(){ removeRow(this); };

                tbody.appendChild(row);
            }
            function removeRow(btn){
                const tr = btn.closest('tr');
                tr.remove();
            }

            const productForm = document.getElementById('product-form');
            productForm.addEventListener('submit', function(e){
                const hidden = document.getElementById('spec-hidden');
                hidden.innerHTML = '';

                const rows = document.querySelectorAll('#spec-table tbody tr');
                rows.forEach((tr, i) => {
                    const diam = tr.querySelector('input[name="spec_diameters[]"]').value || '';
                    const satu = tr.querySelector('input[name="spec_satuans[]"]').value || '';
                    const harga = tr.querySelector('input[name="spec_hargas[]"]').value || '';

                    const keyInput = document.createElement('input');
                    keyInput.type = 'hidden';
                    keyInput.name = 'spec_keys[]';
                    keyInput.value = 'Diameter';
                    hidden.appendChild(keyInput);

                    const valInput = document.createElement('input');
                    valInput.type = 'hidden';
                    valInput.name = 'spec_vals[]';
                    valInput.value = `${diam} | ${satu || 'Pcs'} | ${harga}`;
                    hidden.appendChild(valInput);
                });
            });
        </script>
    </form>
</div>
@endsection
