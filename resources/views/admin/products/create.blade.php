<?php
?>
@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Tambah Product</h1>
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

    <form id="product-form" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <input type="text" name="category" class="form-control" value="{{ old('category') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Short Description</label>
                <input type="text" name="short_description" class="form-control" value="{{ old('short_description') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Aktif</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', true) ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                <div class="form-text">Bisa teks biasa / HTML sesuai kebutuhan.</div>
            </div>

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
                            @php
                                $oldCount = old('spec_keys') ? count(old('spec_keys')) : 1;

                                $parseOldVal = function ($oldVal) {
                                    if (!is_string($oldVal)) return ['', 'Pcs', ''];

                                    $oldVal = trim($oldVal);

                                    $parts = preg_split('/\s*\|\s*/', $oldVal);
                                    if (count($parts) >= 3) {
                                        return [
                                            trim($parts[0] ?? ''),
                                            trim($parts[1] ?? '') !== '' ? trim($parts[1]) : 'Pcs',
                                            trim($parts[2] ?? ''),
                                        ];
                                    }

                                    $parts = preg_split('/\s*-\s*/', $oldVal);
                                    if (count($parts) >= 3) {
                                        return [
                                            trim($parts[0] ?? ''),
                                            trim($parts[1] ?? '') !== '' ? trim($parts[1]) : 'Pcs',
                                            trim($parts[2] ?? ''),
                                        ];
                                    }

                                    return [$oldVal, 'Pcs', ''];
                                };
                            @endphp

                            @for ($i = 0; $i < $oldCount; $i++)
                                @php
                                    $oldVal = old("spec_vals.$i", "");
                                    [$diam, $sat, $harga] = $parseOldVal($oldVal);
                                @endphp
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="spec_diameters[]" value="{{ $diam }}" placeholder="40 Cm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="spec_satuans[]" value="{{ $sat }}" placeholder="Pcs">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="spec_hargas[]" value="{{ $harga }}" placeholder="Rp 650.000">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Hapus</button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                {{-- hidden inputs yang akan disusun ke spec_keys/spec_vals --}}
                <div id="spec-hidden"></div>

                <button type="button" class="btn btn-outline-primary btn-sm" onclick="addRow()">+ Tambah Baris</button>

                <div class="form-text mt-2">
                    Format penyimpanan: tiap baris akan disimpan sebagai spec key/val dengan val = "Diameter | Satuan | Harga".
                </div>
            </div>

            <div class="col-12">
                <hr>
                <h5 class="mb-3">Gambar Product (Multi)</h5>
                <div class="mb-2">
                    <input type="file" name="images[]" class="form-control" multiple required>
                    <div class="form-text mt-2">
                        Upload <strong>maksimal 5</strong> foto (wajib <strong>minimal 5</strong>). Setiap foto minimal <strong>7MB</strong>.
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>

        {{-- Generate spec_keys/spec_vals on submit --}}
        <script>
            function addRow() {
                const tbody = document.querySelector('#spec-table tbody');
                const row = tbody.children[0].cloneNode(true);
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
                    const diamInput = tr.querySelector('input[name="spec_diameters[]"]');
                    const satuInput = tr.querySelector('input[name="spec_satuans[]"]');
                    const hargaInput = tr.querySelector('input[name="spec_hargas[]"]');

                    const diam = diamInput ? (diamInput.value || '') : '';
                    const satu = satuInput ? (satuInput.value || '') : '';
                    const harga = hargaInput ? (hargaInput.value || '') : '';

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
