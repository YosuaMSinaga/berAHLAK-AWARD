@extends('layouts.app')

@section('title', 'Pengaturan Periode Penilaian BerAKHLAK')

@section('content')

{{-- Import Google Fonts: Lato --}}
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-color: #1b5e20;
        --primary-light: #4caf50;
        --primary-soft: #e8f5e9;
        --secondary-color: #1565c0;
        --secondary-soft: #e3f2fd;
        --success-color: #2e7d32;
        --danger-color: #c62828;
        --warning-color: #ef6c00;
        --text-dark: #263238;
        --text-muted: #78909c;
        --border-color: #e2e8f0;
        --background-color: #f8faf9;
        --white: #ffffff;
    }

    html, body {
        font-family: 'Lato', sans-serif;
    }

    body,
    .pengaturan-container,
    .pengaturan-container * {
        font-family: 'Lato', sans-serif;
    }

    .pengaturan-container {
        padding: 8px 16px;
        background: var(--background-color);
        min-height: calc(100vh - 70px);
        font-family: 'Lato', sans-serif;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        margin: 0;
        color: var(--text-dark);
        font-size: 20px;
        font-weight: 700;
    }

    .page-subtitle {
        margin-top: 6px;
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 400;
    }

    .card-custom {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
        margin-bottom: 25px;
        overflow: hidden;
    }

    .card-header-custom {
        padding: 12px 16px;
        border-bottom: 1px solid var(--border-color);
        background: var(--white);
    }

    .card-title {
        margin: 0;
        color: var(--text-dark);
        font-size: 17px;
        font-weight: 700;
    }

    .card-body-custom {
        padding: 16px;
    }

    .form-label-custom {
        display: block;
        margin-bottom: 8px;
        color: var(--text-dark);
        font-size: 13px;
        font-weight: 700;
    }

    .form-control-custom,
    .form-select-custom {
        width: 100%;
        height: 36px;
        padding: 6px 10px;
        border: 1px solid #cfd8dc;
        border-radius: 6px;
        background: #fff;
        color: var(--text-dark);
        font-family: 'Lato', sans-serif;
        font-size: 13px;
        outline: none;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
    }

    .form-group-custom {
        margin-bottom: 20px;
    }

    .custom-btn {
        height: 36px;
        padding: 0 16px;
        border: none;
        border-radius: 50px;
        font-family: 'Lato', sans-serif;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .custom-btn-success-main {
        background: var(--primary-color);
        color: #fff;
        border-radius: 6px;
        height: 36px;
        padding: 0 12px;
        font-size: 13px;
    }

    .custom-btn-success-main:hover {
        background: #124216;
    }

    .custom-btn-primary {
        background: var(--secondary-color);
        color: #fff;
    }

    .custom-btn-primary:hover {
        background: #0d47a1;
    }

    .custom-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 24px;
        padding: 0 8px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-success {
        background: var(--primary-soft);
        color: var(--success-color);
    }

    .badge-secondary {
        background: #eceff1;
        color: #546e7a;
    }

    .badge-light {
        background: #f1f5f9;
        color: #334155;
        font-weight: 600;
    }

    .alert-custom {
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success-custom {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .alert-danger-custom {
        background: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }

    /* Perbaikan Tabel agar Rapi dan Sejajar */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom thead th {
        padding: 10px 12px;
        background: #f8fafc;
        border-bottom: 2px solid var(--border-color);
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        white-space: nowrap;
    }

    .table-custom tbody td {
        padding: 10px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: var(--text-dark);
        font-size: 13px;
        vertical-align: middle;
    }

    .table-custom tbody tr {
        transition: background-color 0.15s ease;
    }

    .table-custom tbody tr:hover {
        background: #f8fafc;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    .text-left {
        text-align: left;
    }

    .text-center {
        text-align: center;
    }

    .error-text {
        display: block;
        margin-top: 5px;
        color: var(--danger-color);
        font-size: 12px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .form-row-three {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    @media (max-width: 768px) {
        .pengaturan-container {
            padding: 15px;
        }

        .form-row,
        .form-row-three {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .page-title {
            font-size: 22px;
        }
    }
</style>

<div class="pengaturan-container">

    {{-- Header --}}
    <div class="page-header">
        <h1 class="page-title">Pengaturan Periode Penilaian</h1>
        <div class="page-subtitle">Kelola periode dan parameter penilaian BerAKHLAK Award System.</div>
    </div>

    {{-- Pesan Berhasil --}}
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan Error --}}
    @if(session('error'))
        <div class="alert-custom alert-danger-custom">
            {{ session('error') }}
        </div>
    @endif

    {{-- Error Validasi --}}
    @if($errors->any())
        <div class="alert-custom alert-danger-custom">
            <strong>Terdapat kesalahan:</strong>
            <ul style="margin: 6px 0 0 16px; padding: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Pengaturan --}}
    <div class="card-custom">
        <div class="card-header-custom">
            <h2 class="card-title">Buat Periode Penilaian Baru</h2>
        </div>
        <div class="card-body-custom">
            <form action="{{ route('setting.store') }}" method="POST">
                @csrf

                {{-- Periode dan Core Value --}}
                <div class="form-row">
                    {{-- Periode --}}
                    <div class="form-group-custom">
                        <label for="periode" class="form-label-custom">Periode Penilaian</label>
                        <input type="text" name="periode" id="periode" class="form-control-custom" placeholder="Contoh: 2026-09" value="{{ old('periode') }}" required>
                        @error('periode')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Core Value --}}
                    <div class="form-group-custom">
                        <label for="value" class="form-label-custom">Core Value</label>
                        <select name="value" id="value" class="form-select-custom" required>
                            <option value="">Pilih Core Value</option>
                            <option value="Berorientasi Pelayanan" {{ old('value') == 'Berorientasi Pelayanan' ? 'selected' : '' }}>Berorientasi Pelayanan</option>
                            <option value="Akuntabel" {{ old('value') == 'Akuntabel' ? 'selected' : '' }}>Akuntabel</option>
                            <option value="Kompeten" {{ old('value') == 'Kompeten' ? 'selected' : '' }}>Kompeten</option>
                            <option value="Harmonis" {{ old('value') == 'Harmonis' ? 'selected' : '' }}>Harmonis</option>
                            <option value="Loyal" {{ old('value') == 'Loyal' ? 'selected' : '' }}>Loyal</option>
                            <option value="Adaptif" {{ old('value') == 'Adaptif' ? 'selected' : '' }}>Adaptif</option>
                            <option value="Kolaboratif" {{ old('value') == 'Kolaboratif' ? 'selected' : '' }}>Kolaboratif</option>
                        </select>
                        @error('value')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Parameter --}}
                <div class="form-row-three">
                    {{-- Jumlah Pilihan --}}
                    <div class="form-group-custom">
                        <label for="jum_pilihan" class="form-label-custom">Jumlah Pilihan</label>
                        <input type="number" name="jum_pilihan" id="jum_pilihan" class="form-control-custom" placeholder="0" min="1" value="{{ old('jum_pilihan') }}" required>
                        @error('jum_pilihan')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Maksimal Pilihan --}}
                    <div class="form-group-custom">
                        <label for="max_pilihan" class="form-label-custom">Maksimal Pilihan</label>
                        <input type="number" name="max_pilihan" id="max_pilihan" class="form-control-custom" placeholder="0" min="1" value="{{ old('max_pilihan') }}" required>
                        @error('max_pilihan')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Kuota Pemenang --}}
                    <div class="form-group-custom">
                        <label for="pemenang" class="form-label-custom">Kuota Pemenang</label>
                        <input type="number" name="pemenang" id="pemenang" class="form-control-custom" placeholder="0" min="1" value="{{ old('pemenang') }}" required>
                        @error('pemenang')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div style="margin-top: 10px;">
                    <button type="submit" class="custom-btn custom-btn-success-main">
                        Simpan & Otomatis Aktifkan Periode
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Riwayat --}}
    <div class="card-custom">
        <div class="card-header-custom">
            <h2 class="card-title">Riwayat Parameter Pengaturan</h2>
        </div>

        <div class="table-wrapper">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%;">Periode</th>
                        <th class="text-left" style="width: 25%;">Core Value</th>
                        <th class="text-center" style="width: 12%;">Pilihan Max</th>
                        <th class="text-center" style="width: 12%;">Tersedia</th>
                        <th class="text-center" style="width: 14%;">Kuota Pemenang</th>
                        <th class="text-center" style="width: 11%;">Status</th>
                        <th class="text-center" style="width: 11%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatSettings as $riwayat)
                        <tr>
                            <td class="text-left" style="font-weight: 700;">{{ $riwayat->periode }}</td>
                            <td class="text-left">{{ $riwayat->value }}</td>
                            <td class="text-center">
                                <span class="custom-badge badge-light">{{ $riwayat->jum_pilihan }} Kriteria</span>
                            </td>
                            <td class="text-center">
                                <span class="custom-badge badge-light">{{ $riwayat->max_pilihan }} Terdisplay</span>
                            </td>
                            <td class="text-center">
                                <span class="custom-badge badge-light">{{ $riwayat->pemenang }} Pegawai</span>
                            </td>
                            <td class="text-center">
                                @if($riwayat->status === 'aktif')
                                    <span class="custom-badge badge-success">aktif</span>
                                @else
                                    <span class="custom-badge badge-secondary">tidak aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($riwayat->status === 'aktif')
                                    <span class="custom-badge badge-success" style="width: 90px;">
                                        Aktif
                                    </span>
                                @else
                                    <form action="{{ route('setting.aktifkan', $riwayat->id) }}" method="POST" style="margin: 0; display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="custom-btn custom-btn-primary" style="width: 90px;">
                                            Aktifkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center" style="padding: 40px; color: var(--text-muted);">
                                Belum ada riwayat parameter pengaturan yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection