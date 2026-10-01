<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">

<div class="form-header-clean d-flex justify-content-between align-items-center gap-4 flex-wrap px-1 py-2">
    <div class="d-flex align-items-center gap-3.5">
        <div class="header-icon-wrapper">
            <i class="bi bi-journal-check"></i>
        </div>
        <div>
            <h3 class="form-main-title mb-1.5">Form Penilaian BerAKHLAK</h3>
            <p class="form-subtitle mb-0">
                Periode Aktif: 
                <span class="fw-bold text-dark">
                    {{ $settingAktif->periode ?? '-' }}
                </span>
            </p>
        </div>
    </div>

    <div class="text-start text-md-end">
        <div class="core-value-label mb-1.5">CORE VALUE AKTIF</div>
        <span class="core-value-badge">
            <i class="bi bi-shield-check me-1.5"></i>
            {{ $settingAktif->value ?? '-' }}
        </span>
    </div>
</div>

<style>
    /* Menerapkan font Lato pada seluruh elemen header */
    .form-header-clean,
    .form-header-clean * {
        font-family: 'Lato', sans-serif !important;
        box-sizing: border-box;
    }

    /* Container tanpa latar/card, diberi margin bawah yang pas */
    .form-header-clean {
        background: transparent;
        border: none;
        box-shadow: none;
        margin-bottom: 28px;
    }

    /* Wrapper ikon */
    .header-icon-wrapper {
        width: 50px;
        height: 50px;
        background: #ecfdf5;
        color: #059669;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        border: 1px solid #d1fae5;
        flex-shrink: 0;
    }

    /* Judul utama dengan jarak bawah yang lega */
    .form-main-title {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.01em;
        margin-bottom: 6px !important;
    }

    /* Subtitle periode */
    .form-subtitle {
        font-size: 14px;
        color: #64748b;
        letter-spacing: 0.01em;
    }

    /* Label core value di kanan */
    .core-value-label {
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.08em;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 6px !important;
    }

    /* Badge core value */
    .core-value-badge {
        display: inline-flex;
        align-items: center;
        background: #f0fdf4;
        color: #047857;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 14.5px;
        font-weight: 700;
        border: 1px solid #bbf7d0;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
    }
</style>