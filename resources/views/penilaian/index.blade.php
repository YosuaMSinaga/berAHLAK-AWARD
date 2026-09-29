@extends('layouts.app')
@section('title', 'Form Penilaian BerAKHLAK')
@section('content')

{{-- =========================================================
     GOOGLE FONT (LATO) & CSS STYLING
     ========================================================= --}}
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">

<style>
/* Terapkan Font Lato ke Seluruh Elemen di Halaman Ini */
.penilaian-wrapper, 
.penilaian-container, 
.penilaian-wrapper * {
    font-family: 'Lato', sans-serif !important;
}

.penilaian-wrapper {
    padding: 1rem 1.5rem;
    background-color: #f4f6f9;
    min-height: 90vh;
    width: 100%;
}

.penilaian-container {
    width: 100%;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    padding: 1.5rem 1.75rem;
    border: 1px solid #e2e8f0;
}

/* Header */
.sticky-form-header {
    border-bottom: 2px solid #edf2f7;
    padding-bottom: 1rem;
    margin-bottom: 1.25rem;
}

.form-main-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 0.15rem;
}

.form-subtitle {
    font-size: 0.88rem;
    color: #4a5568;
    margin-bottom: 0;
}

.core-value-label {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: #a0aec0;
    margin-bottom: 0.15rem;
    display: block;
}

.core-value-badge {
    background-color: #f0fdf4;
    color: #166534;
    padding: 0.35rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    border: 1px solid #bbf7d0;
}

/* Alerts */
.form-alert {
    padding: 0.75rem 1rem;
    border-radius: 6px;
    margin-bottom: 1.25rem;
    font-size: 0.88rem;
}

.form-alert-success {
    background-color: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.form-alert-danger {
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

/* Empty Box */
.empty-box {
    text-align: center;
    padding: 2.5rem 1.25rem;
    background-color: #f8fafc;
    border: 2px dashed #cbd5e1;
    border-radius: 8px;
    color: #64748b;
    font-size: 0.9rem;
}

/* Section Blocks */
.section-block {
    margin-bottom: 1.5rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1.25rem;
}

.form-section-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.15rem;
}

.form-section-description {
    font-size: 0.85rem;
    color: #718096;
    margin-bottom: 0.75rem;
}

.selection-counter {
    background: #edf2f7;
    color: #2d3748;
    padding: 0.3rem 0.65rem;
    border-radius: 5px;
    font-size: 0.8rem;
    font-weight: 600;
    border: 1px solid #e2e8f0;
}

/* Bagian 1: Implementasi List */
.implementasi-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
    gap: 0.6rem;
    margin-top: 0.75rem;
}

.implementasi-item {
    display: block;
    background: #ffffff;
    border: 1px solid #cbd5e0;
    border-radius: 6px;
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

.implementasi-item:hover {
    border-color: #3182ce;
    box-shadow: 0 2px 4px rgba(49, 130, 206, 0.06);
    background-color: #f7fafc;
}

.implementasi-content {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.implementasi-checkbox {
    margin-top: 0.2rem;
    transform: scale(1.05);
    cursor: pointer;
}

.implementasi-text-wrapper {
    font-size: 0.9rem;
    color: #2d3748;
    line-height: 1.45;
}

.implementasi-number {
    font-weight: 700;
    color: #4a5568;
    margin-right: 0.25rem;
}

/* Bagian 2: Employee Grid */
.employee-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 0.75rem;
    margin-top: 0.75rem;
}

.employee-card {
    background: #ffffff;
    border: 1px solid #cbd5e0;
    border-radius: 6px;
    padding: 0.85rem;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    display: flex;
    flex-direction: column;
}

.employee-card:hover {
    border-color: #3182ce;
    box-shadow: 0 3px 8px rgba(49, 130, 206, 0.06);
    background-color: #f7fafc;
}

.employee-card-inner {
    display: flex;
    align-items: flex-start;
    gap: 0.65rem;
}

.employee-checkbox {
    margin-top: 0.2rem;
    transform: scale(1.05);
    cursor: pointer;
}

.employee-name {
    font-weight: 700;
    font-size: 0.9rem;
    color: #1a202c;
}

.employee-nip {
    font-size: 0.8rem;
    color: #718096;
    margin-top: 0.1rem;
}

.employee-position {
    font-size: 0.75rem;
    color: #2b6cb0;
    background: #ebf8ff;
    padding: 0.15rem 0.5rem;
    border-radius: 4px;
    display: inline-block;
    margin-top: 0.35rem;
    border: 1px solid #bee3f8;
    font-weight: 600;
}

/* Submit Button */
.submit-button {
    width: 100%;
    background-color: #2f855a;
    border: none;
    color: white;
    padding: 0.75rem 1.25rem;
    font-size: 0.95rem;
    font-weight: 700;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s;
    box-shadow: 0 3px 8px rgba(47, 133, 90, 0.15);
}

.submit-button:hover {
    background-color: #276749;
}

/* Modal Konfirmasi Styling */
.summary-modal-content {
    border: none;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    overflow: hidden;
}

.summary-modal-header {
    background-color: #2f855a;
    color: white;
    padding: 1rem 1.25rem;
}

.summary-modal-title {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0;
}

.summary-modal-body {
    padding: 1.25rem;
    max-height: 60vh;
    overflow-y: auto;
}

.summary-warning {
    background-color: #fffaf0;
    color: #9c4221;
    padding: 0.75rem 0.85rem;
    border-radius: 6px;
    font-size: 0.82rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border: 1px solid #feebc8;
}

.summary-title {
    font-weight: 700;
    font-size: 0.88rem;
    color: #2d3748;
    margin-top: 1rem;
    margin-bottom: 0.4rem;
}

.summary-list {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 0.6rem 0.85rem;
    font-size: 0.83rem;
    color: #2d3748;
}

.summary-list li {
    padding: 0.25rem 0;
    border-bottom: 1px dashed #cbd5e0;
}

.summary-list li:last-child {
    border-bottom: none;
}

.summary-modal-footer {
    background-color: #f8fafc;
    padding: 0.75rem 1.25rem;
    border-top: 1px solid #e2e8f0;
}

@media (max-width: 768px) {
    .penilaian-wrapper {
        padding: 0.75rem;
    }
    .penilaian-container {
        padding: 1rem;
    }
    .section-block {
        padding: 1rem;
    }
}
</style>

<div class="penilaian-wrapper">
    <div class="penilaian-container">

        {{-- =====================================================
             HEADER
             ===================================================== --}}
        <div class="sticky-form-header">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                <div>
                    <h3 class="form-main-title">
                        Form Penilaian BerAKHLAK
                    </h3>
                    <p class="form-subtitle">
                        Periode Aktif:
                        <span class="fw-bold text-dark">
                            {{ $settingAktif->periode ?? '-' }}
                        </span>
                    </p>
                </div>

                <div class="core-value-area text-start text-sm-end">
                    <span class="core-value-label d-none d-sm-block">
                        CORE VALUE AKTIF
                    </span>
                    <span class="core-value-badge">
                        <i class="bi bi-shield-check me-1"></i>
                        {{ $settingAktif->value ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- =====================================================
             ALERTS
             ===================================================== --}}
        @if(session('success'))
            <div class="form-alert form-alert-success">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="form-alert form-alert-danger">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="form-alert form-alert-danger">
                <strong>
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    Terjadi kesalahan:
                </strong>
                <ul class="mb-0 mt-1 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- =====================================================
             CEK PERIODE AKTIF
             ===================================================== --}}
        @if(!$settingAktif)
            <div class="empty-box">
                <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                <strong>Belum ada periode penilaian aktif.</strong>
                <div class="mt-1">
                    Silakan menunggu admin mengaktifkan periode penilaian.
                </div>
            </div>
        @else

            {{-- =================================================
                 FORM
                 ================================================= --}}
            <form
                id="penilaian-form"
                action="{{ route('penilaian.store') }}"
                method="POST"
            >
                @csrf

                <input type="hidden" name="periode" value="{{ $settingAktif->periode }}">
                <input type="hidden" name="value" value="{{ $settingAktif->value }}">

                {{-- =================================================
                     BAGIAN 1
                     ================================================= --}}
                <div class="section-block">
                    <div class="d-flex justify-content-between align-items-start gap-2 flex-wrap">
                        <div>
                            <h5 class="form-section-title">
                                Bagian 1: Pilih Implementasi Nilai
                            </h5>
                            <p class="form-section-description">
                                Pilih maksimal
                                <span class="fw-bold text-success">
                                    {{ $settingAktif->max_pilihan ?? 1 }}
                                </span>
                                poin implementasi berikut.
                            </p>
                        </div>
                        <span class="selection-counter" id="implementation-counter">
                            0 / {{ $settingAktif->max_pilihan ?? 1 }}
                        </span>
                    </div>

                    <div class="implementasi-list">
                        @forelse($implementasi ?? [] as $index => $item)
                            @php
                                if (is_array($item)) {
                                    $implementasiText = $item['implementasi'] ?? $item['text'] ?? $item['value'] ?? $item['nama'] ?? '-';
                                } else {
                                    $implementasiText = $item->implementasi ?? $item->text ?? $item->value ?? $item->nama ?? '-';
                                }
                            @endphp

                            <label class="implementasi-item" for="implementasi_{{ $index }}">
                                <div class="implementasi-content">
                                    <input
                                        type="checkbox"
                                        class="implementasi-checkbox"
                                        id="implementasi_{{ $index }}"
                                        name="pilihan_berakhlak[]"
                                        value="{{ $implementasiText }}"
                                    >
                                    <div class="implementasi-text-wrapper">
                                        <span class="implementasi-number">{{ $index + 1 }}.</span>
                                        <span class="implementasi-text">{{ $implementasiText }}</span>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="empty-box">
                                <i class="bi bi-list-check fs-4 d-block mb-2"></i>
                                Belum ada data implementasi untuk <strong>{{ $settingAktif->value }}</strong>.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- =================================================
                     BAGIAN 2
                     ================================================= --}}
                <div class="section-block">
                    <div class="d-flex justify-content-between align-items-start gap-2 flex-wrap">
                        <div>
                            <h5 class="form-section-title">
                                Bagian 2: Pegawai Pelaksana Nilai
                            </h5>
                            <p class="form-section-description">
                                Centang rekan kerja yang dinilai sudah melaksanakan kriteria di atas secara nyata.
                            </p>
                        </div>
                        <span class="selection-counter employee-counter" id="employee-counter">
                            0 dipilih
                        </span>
                    </div>

                    <div class="employee-grid">
                        @forelse($pegawai ?? [] as $index => $pegawaiItem)
                            @php
                                $pegawaiName = $pegawaiItem->name ?? '-';
                                $pegawaiNip = $pegawaiItem->nip ?? '-';
                                $pegawaiJabatan = $pegawaiItem->jabatan ?? '';
                            @endphp

                            <label class="employee-card" for="pegawai_{{ $index }}">
                                <div class="employee-card-inner">
                                    <input
                                        type="checkbox"
                                        class="employee-checkbox"
                                        id="pegawai_{{ $index }}"
                                        name="pilihan_pegawai[]"
                                        value="{{ $pegawaiNip }}"
                                    >
                                    <div>
                                        <div class="employee-name">{{ $pegawaiName }}</div>
                                        <div class="employee-nip">NIP: {{ $pegawaiNip }}</div>
                                        @if($pegawaiJabatan)
                                            <div class="employee-position">{{ $pegawaiJabatan }}</div>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="empty-box" style="grid-column: 1 / -1;">
                                <i class="bi bi-people fs-4 d-block mb-2"></i>
                                Belum ada pegawai yang tersedia.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- =================================================
                     SUBMIT BUTTON
                     ================================================= --}}
                <button
                    type="submit"
                    id="btn-submit-penilaian"
                    class="submit-button"
                >
                    <i class="bi bi-send-check-fill me-2"></i>
                    Kirim Penilaian
                </button>

            </form>
        @endif

    </div>
</div>

@endsection