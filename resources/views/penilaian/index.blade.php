@extends('layouts.app')

@section('title', 'Daftar Penilaian BerAKHLAK')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">

@php
    $role = auth()->user()->role;
    $canNilai = in_array($role, ['admin', 'user']);
    $formRoute = $role === 'admin' ? 'penilaian.form' : 'user.penilaian.form';
@endphp

<style>
    :root {
        --primary-color: #1b5e20;
        --primary-soft: #e8f5e9;
        --success-color: #2e7d32;
        --text-dark: #263238;
        --text-muted: #78909c;
        --border-color: #e2e8f0;
        --background-color: #f8faf9;
        --white: #ffffff;
    }

    html, body,
    .pengaturan-container,
    .pengaturan-container * {
        font-family: 'Lato', sans-serif;
    }

    .pengaturan-container {
        padding: 8px 16px;
        background: var(--background-color);
        min-height: calc(100vh - 70px);
    }

    .page-header { margin-bottom: 30px; }
    .page-title { margin: 0; color: var(--text-dark); font-size: 20px; font-weight: 700; }
    .page-subtitle { margin-top: 6px; color: var(--text-muted); font-size: 14px; }

    .card-custom {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.03);
        margin-bottom: 25px;
        overflow: hidden;
    }

    .card-header-custom { padding: 12px 16px; border-bottom: 1px solid var(--border-color); }
    .card-title { margin: 0; color: var(--text-dark); font-size: 17px; font-weight: 700; }

    .alert-custom { padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
    .alert-success-custom { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
    .alert-danger-custom { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }

    .table-wrapper { width: 100%; overflow-x: auto; }
    .table-custom { width: 100%; border-collapse: collapse; }

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

    .table-custom tbody tr:last-child td { border-bottom: none; }
    .table-custom tbody tr.row-clickable { cursor: pointer; transition: background-color .15s ease; }
    .table-custom tbody tr.row-clickable:hover { background: var(--primary-soft); }
    .table-custom tbody tr.row-disabled { opacity: .6; }

    .text-left { text-align: left; }
    .text-center { text-align: center; }

    .custom-badge {
        display: inline-flex; align-items: center; justify-content: center;
        height: 24px; padding: 0 8px; border-radius: 30px;
        font-size: 12px; font-weight: 700;
    }
    .badge-success { background: var(--primary-soft); color: var(--success-color); }
    .badge-secondary { background: #eceff1; color: #546e7a; }
    .badge-light { background: #f1f5f9; color: #334155; font-weight: 600; }

    .custom-btn {
        height: 32px; padding: 0 14px; border: none; border-radius: 6px;
        font-size: 13px; font-weight: 700; text-decoration: none;
        display: inline-flex; align-items: center; justify-content: center;
        transition: all .2s ease; width: 90px;
    }
    .custom-btn-success-main { background: var(--primary-color); color: #fff; }
    .custom-btn-success-main:hover { background: #124216; color: #fff; }
    .custom-btn-disabled { background: #eceff1; color: #90a4ae; cursor: not-allowed; }

    @media (max-width: 768px) {
        .pengaturan-container { padding: 15px; }
        .page-title { font-size: 22px; }
    }
</style>

<div class="pengaturan-container">

    <div class="page-header">
        <h1 class="page-title">Daftar Penilaian</h1>
        <div class="page-subtitle">Pilih periode penilaian BerAKHLAK untuk mulai memberikan penilaian.</div>
    </div>

    @if(session('success'))
        <div class="alert-custom alert-success-custom">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-custom alert-danger-custom">{{ session('error') }}</div>
    @endif

    <div class="card-custom">
        <div class="card-header-custom">
            <h2 class="card-title">Periode Penilaian</h2>
        </div>

        <div class="table-wrapper">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 18%;">Periode</th>
                        <th class="text-left" style="width: 28%;">Core Value</th>
                        <th class="text-center" style="width: 16%;">Kriteria</th>
                        <th class="text-center" style="width: 14%;">Status</th>
                        <th class="text-center" style="width: 14%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatSettings as $setting)
                        @php
                            $aktif = $setting->status === 'aktif';
                            $bisaDiklik = $aktif && $canNilai;
                        @endphp

                        <tr class="{{ $bisaDiklik ? 'row-clickable' : 'row-disabled' }}"
                            @if($bisaDiklik) onclick="window.location='{{ route($formRoute, $setting->id) }}'" @endif>
                            <td class="text-left" style="font-weight: 700;">{{ $setting->periode }}</td>
                            <td class="text-left">{{ $setting->value }}</td>
                            <td class="text-center">
                                <span class="custom-badge badge-light">{{ $setting->jum_pilihan }} Kriteria</span>
                            </td>
                            <td class="text-center">
                                <span class="custom-badge {{ $aktif ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $aktif ? 'aktif' : 'tidak aktif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($bisaDiklik)
                                    <a href="{{ route($formRoute, $setting->id) }}"
                                       class="custom-btn custom-btn-success-main"
                                       onclick="event.stopPropagation()">
                                        Nilai
                                    </a>
                                @else
                                    <span class="custom-btn custom-btn-disabled">{{ $aktif ? '-' : 'Ditutup' }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center" style="padding: 40px; color: var(--text-muted);">
                                Belum ada periode penilaian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection