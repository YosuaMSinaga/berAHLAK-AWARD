{{-- POPUP KONFIRMASI (Modern Redesign & Lato Font) --}}
{{-- Pastikan font Lato dan Bootstrap Icons sudah di-import di layout utama Anda --}}
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="kp-overlay" id="konfirmasiPenilaianModal" aria-hidden="true">
    <div class="kp-box" role="dialog" aria-modal="true" aria-labelledby="kp-title">

        {{-- HEADER --}}
        <div class="kp-header">
            <div class="kp-title-wrapper">
                <div class="kp-icon-badge">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <h5 class="kp-title" id="kp-title">Konfirmasi Penilaian</h5>
                    <span class="kp-subtitle">Periksa kembali data sebelum disimpan ke sistem</span>
                </div>
            </div>
            <button type="button" class="kp-close" data-kp-close aria-label="Tutup">
                <i class="bi bi-x"></i>
            </button>
        </div>

        {{-- BODY --}}
        <div class="kp-body">

            <div class="kp-alert">
                <i class="bi bi-info-circle-fill"></i>
                <span>Pastikan data penilaian yang Anda pilih sudah benar dan sesuai sebelum melakukan konfirmasi akhir.</span>
            </div>

            <div class="kp-grid">

                <div class="kp-item">
                    <small>Periode</small>
                    <strong id="popup-periode">-</strong>
                </div>

                <div class="kp-item">
                    <small>Core Value</small>
                    <strong id="popup-value">-</strong>
                </div>

                <div class="kp-item kp-full">
                    <div class="kp-item-title">Implementasi Nilai</div>
                    <div id="popup-implementasi" class="kp-content-box">-</div>
                </div>

                <div class="kp-item kp-full">
                    <div class="kp-item-title">Pegawai yang Dinilai</div>
                    <div id="popup-pegawai" class="kp-content-box">-</div>
                </div>

            </div>
        </div>

        {{-- FOOTER --}}
        <div class="kp-footer">
            <button type="button" class="kp-btn kp-btn-secondary" data-kp-close>
                <i class="bi bi-arrow-left"></i> Batal
            </button>

            <button type="button" class="kp-btn kp-btn-success" id="btn-konfirmasi-penilaian">
                <span>Ya, Simpan Penilaian</span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>

    </div>
</div>

<style>
    /* Mengaplikasikan Font Lato pada seluruh elemen di dalam popup */
    .kp-overlay, 
    .kp-overlay * {
        font-family: 'Lato', sans-serif !important;
        box-sizing: border-box;
    }

    /* Latar gelap dengan efek modern glassmorphism tipis */
    .kp-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 99999;
    }

    .kp-overlay.show {
        display: flex;
        animation: kp-fade .25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* Kotak popup mengambang dengan gaya modern minimalis */
    .kp-box {
        background: #ffffff;
        width: 100%;
        max-width: 720px;
        max-height: 90vh;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.8);
        animation: kp-pop .3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* Header yang lebih elegan */
    .kp-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 24px;
        background: #fafafa;
        border-bottom: 1px solid #f1f5f9;
    }

    .kp-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kp-icon-badge {
        width: 40px;
        height: 40px;
        background: #ecfdf5;
        color: #059669;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .kp-title {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.01em;
    }

    .kp-subtitle {
        font-size: 13px;
        color: #64748b;
        font-weight: 400;
    }

    .kp-close {
        background: #f1f5f9;
        border: 0;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        font-size: 18px;
        color: #64748b;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .2s ease;
    }

    .kp-close:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* Body dengan jarak dan kontras yang nyaman */
    .kp-body {
        padding: 24px;
        overflow-y: auto;
    }

    .kp-alert {
        background: #f8fafc;
        color: #334155;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #0284c7;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 13.5px; /* Diperbaiki dari 13.5kpx */
        display: flex;
        align-items: flex-start;
        gap: 10px;
        line-height: 1.5;
    }

    .kp-alert i {
        color: #0284c7;
        font-size: 16px;
        margin-top: 1px;
    }

    .kp-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .kp-item {
        background: #fcfcfc;
        border: 1px solid #f1f5f9;
        border-radius: 10px;
        padding: 14px 16px;
        transition: border-color .2s;
    }

    .kp-item:hover {
        border-color: #e2e8f0;
    }

    .kp-full {
        grid-column: 1 / -1;
    }

    .kp-item small {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .kp-item strong {
        font-size: 14.5px;
        color: #1e293b;
        font-weight: 700;
    }

    .kp-item-title {
        font-weight: 700;
        font-size: 13px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }

    .kp-content-box {
        font-size: 14px;
        color: #1e293b;
        line-height: 1.5;
    }

    .kp-item ul {
        margin: 0;
        padding-left: 18px;
    }

    .kp-item li {
        margin-bottom: 4px;
    }

    .kp-pegawai {
        padding: 10px 12px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .kp-pegawai:last-child {
        margin-bottom: 0;
    }

    .kp-pegawai-name {
        font-weight: 700;
        color: #1e293b;
    }

    .kp-pegawai-info {
        color: #64748b;
        font-size: 13px;
    }

    /* Footer modern */
    .kp-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 16px 24px;
        background: #fafafa;
        border-top: 1px solid #f1f5f9;
    }

    .kp-btn {
        border: 0;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all .2s ease;
    }

    .kp-btn-secondary {
        background: #ffffff;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .kp-btn-secondary:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .kp-btn-success {
        background: #059669;
        color: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.2);
    }

    .kp-btn-success:hover {
        background: #047857;
        box-shadow: 0 6px 8px -1px rgba(5, 150, 105, 0.3);
    }

    .kp-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
        box-shadow: none;
    }

    /* Kunci scroll halaman saat popup terbuka */
    body.kp-open {
        overflow: hidden;
    }

    @keyframes kp-fade {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @keyframes kp-pop {
        from { opacity: 0; transform: translateY(12px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    @media (max-width: 576px) {
        .kp-grid {
            grid-template-columns: 1fr;
        }

        .kp-footer {
            flex-direction: column-reverse;
        }

        .kp-btn {
            width: 100%;
        }
    }
</style>