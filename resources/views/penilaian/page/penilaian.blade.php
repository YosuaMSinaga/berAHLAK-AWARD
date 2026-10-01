@extends('layouts.app')

@section('title', 'Form Penilaian BerAKHLAK')

@section('content')

{{-- Memuat Google Fonts: Lato --}}
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">

@php
    $isAdmin = auth()->user()->role === 'admin';
    $storeRoute = $isAdmin ? 'penilaian.store' : 'user.penilaian.store';
    $backRoute  = $isAdmin ? 'penilaian.index' : 'user.penilaian';
@endphp

<style>
    /* Menerapkan font Lato ke seluruh elemen di halaman penilaian */
    .penilaian-wrapper, 
    .penilaian-wrapper * {
        font-family: 'Lato', sans-serif !important;
        box-sizing: border-box;
    }

    .penilaian-wrapper {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 24px 32px 60px;
        background-color: #f8fafc;
        min-height: 100vh;
    }

    /* HEADER DI LUAR CARD */
    .page-header-container {
        margin-bottom: 24px;
    }

    /* CARD UTAMA (FORM CONTAINER) */
    .penilaian-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.03), 0 4px 6px -4px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        width: 100%;
    }

    .form-body {
        padding: 36px;
    }

    /* SECTION CARD (Bagian 1 & Bagian 2) */
    .section-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        margin-bottom: 28px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }

    .section-header {
        background: #fafafa;
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
    }

    .section-title {
        margin: 0 0 4px 0;
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.01em;
    }

    .section-description {
        margin: 0;
        color: #64748b;
        font-size: 13.5px;
    }

    .section-body {
        padding: 24px;
    }

    /* PILIHAN CARD STYLING */
    .choice-card {
        position: relative;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 18px;
        margin-bottom: 0;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .choice-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .choice-card.selected {
        border-color: #10b981;
        background: #f0fdf4;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.06);
    }

    .choice-card .form-check {
        margin: 0;
        padding: 0;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .choice-card .form-check-input {
        margin-top: 2px;
        cursor: pointer;
        flex-shrink: 0;
    }

    .choice-card .form-check-label {
        cursor: pointer;
        width: 100%;
        padding-left: 0;
    }

    .choice-text {
        color: #334155;
        line-height: 1.5;
        font-size: 14px;
        font-weight: 500;
    }

    .choice-card.selected .choice-text {
        color: #064e3b;
        font-weight: 600;
    }

    .pegawai-name {
        font-weight: 700;
        color: #1e293b;
        font-size: 14.5px;
        margin-bottom: 2px;
    }

    .choice-card.selected .pegawai-name {
        color: #064e3b;
    }

    .pegawai-info {
        color: #64748b;
        font-size: 12.5px;
        margin-top: 2px;
    }

    /* SELECTION COUNTER BADGE */
    .selection-counter {
        display: inline-flex;
        align-items: center;
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        padding: 6px 12px;
        font-size: 13.5px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* TITLE UTAMA & SUBTITLE */
    .form-main-title {
        font-weight: 800;
        color: #0f172a;
        font-size: 22px;
        margin-bottom: 4px;
        letter-spacing: -0.01em;
    }

    .form-subtitle {
        color: #64748b;
        margin-bottom: 0;
        font-size: 13.5px;
    }

    .core-value-label {
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .core-value-badge {
        display: inline-flex;
        align-items: center;
        background: #f0fdf4;
        color: #047857;
        border-radius: 10px;
        padding: 6px 14px;
        font-size: 13.5px;
        font-weight: 700;
        border: 1px solid #bbf7d0;
    }

    /* EMPTY STATE */
    .empty-state {
        padding: 48px 20px;
        text-align: center;
        color: #64748b;
    }

    .empty-state i {
        font-size: 42px;
        margin-bottom: 14px;
        color: #94a3b8;
    }

    /* SUBMIT AREA & TOMBOL-TOMBOL */
    .submit-area {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        margin-top: 32px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }

    /* TOMBOL LANJUTKAN PENILAIAN (SUCCESS) */
    .btn-success {
        background-color: #008000 !important;
        border-color: #008000 !important;
        color: #ffffff !important;
        font-weight: 700;
        font-size: 15px; 
        padding: 12px 24px; 
        border-radius: 10px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px rgba(0, 128, 0, 0.15);
    }

    .btn-success:hover {
        background-color: #006600 !important;
        border-color: #006600 !important;
        color: #ffffff !important;
        box-shadow: 0 6px 12px rgba(0, 102, 0, 0.2);
    }

    /* TOMBOL KEMBALI (OUTLINE SEKUNDER) */
    .btn-outline-secondary {
        border-color: #cbd5e1 !important;
        color: #475569 !important;
        font-weight: 700;
        font-size: 15px;
        padding: 12px 24px;
        border-radius: 10px;
        background: #ffffff !important;
        transition: all 0.2s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #f1f5f9 !important;
        border-color: #94a3b8 !important;
        color: #1e293b !important;
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 768px) {
        .penilaian-wrapper {
            padding: 12px 12px 40px;
        }

        .form-body {
            padding: 20px;
        }

        .section-body {
            padding: 16px;
        }

        .submit-area {
            flex-direction: column-reverse;
        }

        .submit-area button,
        .submit-area a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="penilaian-wrapper">

    {{-- HEADER DI LUAR CARD UTAMA --}}
    <div class="page-header-container">
        @include('penilaian.partials.header')
    </div>

    <div class="penilaian-card">
        <div class="form-body">

            {{-- PESAN SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- PESAN ERROR --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- VALIDATION ERROR --}}
            @if($errors->any())
                <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                    <div class="fw-bold mb-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Terdapat kesalahan pada input Anda:
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- BELUM ADA SETTING --}}
            @if(!$settingAktif)
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <h5 class="fw-bold text-dark">Belum Ada Periode Penilaian Aktif</h5>
                    <p class="mb-0 text-muted font-sm">Silakan menunggu admin mengaktifkan periode penilaian terlebih dahulu.</p>
                </div>
            @else
                {{-- FORM UTAMA --}}
                <form id="penilaian-form" action="{{ route($storeRoute) }}" method="POST">
                    @csrf

                    <input type="hidden" name="periode" value="{{ $settingAktif->periode }}">
                    <input type="hidden" name="value" value="{{ $settingAktif->value }}">

                    {{-- BAGIAN IMPLEMENTASI --}}
                    @include('penilaian.partials.implementasi')

                    {{-- BAGIAN PEGAWAI --}}
                    @include('penilaian.partials.pegawai')

                    {{-- TOMBOL AKSI (SUBMIT & KEMBALI) --}}
                    <div class="submit-area">
                        <a href="{{ route($backRoute) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success" id="btn-submit-penilaian">
                            <i class="bi bi-check2-circle me-1"></i> Lanjutkan Penilaian
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </div>
</div>

{{-- POPUP KONFIRMASI --}}
@include('penilaian.popup.konfirmasi')

{{-- JAVASCRIPT --}}
@include('penilaian.partials.script')

@endsection