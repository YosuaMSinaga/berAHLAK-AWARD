@extends('layouts.app')

@section('title', 'BerAKHLAK Award Management')

@section('content')

<div class="award-wrapper">

    <!-- =========================================================
         HEADER HALAMAN
    ========================================================== -->
    <div class="page-hero-header">

        <div class="hero-title-area">
            <h2>
                <i class="bi bi-award"></i>
                BerAKHLAK Award Management
            </h2>

            <p>
                Kelola penetapan pemenang bulanan dan pratinjau dokumen
                sertifikat penghargaan pegawai.
            </p>
        </div>

        <div class="hero-badge-periode">
            <i class="bi bi-calendar-event"></i>
            Periode Aktif:
            <strong>2026 06</strong>
        </div>

    </div>


    <!-- =========================================================
         PANEL PENETAPAN PEMENANG
    ========================================================== -->
    <div class="modern-card main-action-card">

        <div class="card-body-flex">

            <div class="action-info">

                <span class="badge-label">
                    Penetapan Periode Berjalan
                </span>

                <h4>
                    Core Value Bulan Ini:
                    <strong>Kolaboratif</strong>
                </h4>

                <div class="meta-stack">
                    <p class="text-muted mb-1">
                        Kuota: 1 Pegawai
                    </p>

                    <p class="text-muted mb-0">
                        Sumber Data: dbolah (Skor Akhir)
                    </p>
                </div>

            </div>

            <div class="action-btn-wrapper">
                <button
                    type="button"
                    id="btn-trigger-pemenang"
                    onclick="handlePenetapanPemenang()"
                    class="btn-modern btn-primary-modern">

                    <i class="bi bi-lightning-charge-fill"></i>
                    Tentukan & Rekam Pemenang

                </button>
            </div>

        </div>

        <div
            id="pemenang-alert"
            class="alert-modern d-none mt-3">
        </div>

    </div>


    <!-- =========================================================
         RIWAYAT PEMENANG
    ========================================================== -->
    <div class="modern-card">

        <div class="card-header-modern">

            <h5>
                <i class="bi bi-clock-history"></i>
                Riwayat Pemenang BerAKHLAK Award
            </h5>

            <span class="text-muted small">
                Daftar seluruh periode yang telah terekam sistem
            </span>

        </div>


        <div class="table-responsive">

            <table class="table-modern">

                <thead>
                    <tr>

                        <th
                            class="text-center"
                            style="width: 120px;">
                            Periode
                        </th>

                        <th>
                            Core Value
                        </th>

                        <th
                            class="text-center"
                            style="width: 120px;">
                            Peringkat
                        </th>

                        <th>
                            Nama & NIP Pemenang
                        </th>

                        <th>
                            No. Sertifikat
                        </th>

                    </tr>
                </thead>


                <tbody id="table-pemenang-body">

                    <!-- =================================================
                         PERIODE 2026 02
                    ================================================== -->
                    <tr>

                        <td class="text-center font-weight-bold">
                            2026 02
                        </td>

                        <td>
                            <span class="core-tag kompeten">
                                Kompeten
                            </span>
                        </td>

                        <td class="text-center">
                            <span class="rank-badge">
                                Juara 1
                            </span>
                        </td>

                        <td>
                            <div class="winner-name">
                                Juando Siallagan, S.Tr.Stat.
                            </div>

                            <div class="winner-nip">
                                NIP. 340061848
                            </div>
                        </td>

                        <td id="sertifikat-2026-02">
                            <code class="code-pill">
                                B-410/1210/TS.220/2026
                            </code>
                        </td>

                    </tr>


                    <!-- =================================================
                         PERIODE 2026 01
                    ================================================== -->
                    <tr>

                        <td class="text-center font-weight-bold">
                            2026 01
                        </td>

                        <td>
                            <span class="core-tag akuntabel">
                                Akuntabel
                            </span>
                        </td>

                        <td class="text-center">
                            <span class="rank-badge">
                                Juara 1
                            </span>
                        </td>

                        <td>
                            <div class="winner-name">
                                Sangaptua Deo Datus Sagala, S.Tr.Stat.
                            </div>

                            <div class="winner-nip">
                                NIP. 340059765
                            </div>
                        </td>

                        <td id="sertifikat-2026-01">
                            <code class="code-pill">
                                B-208/1210/TS.220/2026
                            </code>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- =============================================================
     MODAL EDIT NOMOR SERTIFIKAT
============================================================= -->
<div
    class="modal-overlay-custom"
    id="modalEditNoSertifikat"
    style="display: none;">

    <div class="modal-box edit-modal-box">

        <div class="modal-header-modern">

            <h6>
                <i class="bi bi-pencil-square"></i>
                Edit Nomor Sertifikat
            </h6>

            <button
                type="button"
                class="close-btn"
                onclick="closeEditModal()">

                &times;

            </button>

        </div>


        <div class="modal-body-modern">

            <input
                type="hidden"
                id="edit-cert-periode">

            <input
                type="hidden"
                id="edit-cert-nip">


            <div class="input-group-modern">

                <label>
                    Pegawai Pemenang
                </label>

                <input
                    type="text"
                    id="edit-cert-nama"
                    class="form-input"
                    readonly>

            </div>


            <div class="input-group-modern">

                <label>
                    Nomor Sertifikat Baru
                </label>

                <input
                    type="text"
                    id="edit-cert-nosert"
                    class="form-input"
                    placeholder="Misal: B-XXX/1210/TS.220/2026">

                <span class="form-help">
                    Kosongkan jika ingin kembali menggunakan
                    nomor otomatis sistem.
                </span>

            </div>

        </div>


        <div class="modal-footer-modern">

            <button
                type="button"
                class="btn-modern btn-secondary-modern"
                onclick="closeEditModal()">

                Batal

            </button>


            <button
                type="button"
                class="btn-modern btn-primary-modern"
                onclick="handleSaveNoSertifikat()">

                <i class="bi bi-check-lg"></i>
                Simpan Perubahan

            </button>

        </div>

    </div>

</div>


<!-- =============================================================
     MODAL PREVIEW SERTIFIKAT
============================================================= -->
<div
    class="modal-overlay-custom"
    id="modalSertifikat"
    style="display: none;">

    <div class="modal-box modal-xl-custom">

        <!-- HEADER MODAL -->
        <div class="modal-header-modern dark-header">

            <h6>
                <i class="bi bi-file-earmark-pdf-fill text-warning"></i>
                Draft Sertifikat Penghargaan
            </h6>

            <button
                type="button"
                class="close-btn"
                onclick="closePreviewModal()">

                &times;

            </button>

        </div>


        <!-- BODY MODAL -->
        <div class="preview-canvas-container">

            <!-- =====================================================
                 SERTIFIKAT
            ====================================================== -->
            <article
                id="cert-print-area"
                class="certificate">

                <!-- FRAME -->
                <div
                    class="frame-outer"
                    aria-hidden="true">
                </div>

                <div
                    class="frame-middle"
                    aria-hidden="true">
                </div>

                <div
                    class="frame-inner"
                    aria-hidden="true">
                </div>


                <!-- CORNER DECORATION -->
                <div
                    class="corner-tech corner-tl"
                    aria-hidden="true">

                    <span></span>

                </div>


                <div
                    class="corner-tech corner-tr"
                    aria-hidden="true">

                    <span></span>

                </div>


                <div
                    class="corner-tech corner-br"
                    aria-hidden="true">

                    <span></span>

                </div>


                <div
                    class="corner-tech corner-bl"
                    aria-hidden="true">

                    <span></span>

                </div>


                <!-- CIRCUIT LEFT -->
                <div
                    class="circuit circuit-left"
                    aria-hidden="true">

                    <span class="circuit-line one"></span>
                    <span class="circuit-line two"></span>
                    <span class="circuit-line three"></span>

                </div>


                <!-- CIRCUIT RIGHT -->
                <div
                    class="circuit circuit-right"
                    aria-hidden="true">

                    <span class="circuit-line one"></span>
                    <span class="circuit-line two"></span>
                    <span class="circuit-line three"></span>

                </div>


                <!-- ORBIT WATERMARK -->
                <div
                    class="orbit-watermark"
                    aria-hidden="true">

                    <span class="orbit-core"></span>

                </div>


                <!-- KONTEN SERTIFIKAT -->
                <div class="certificate-content">

                    <!-- HEADER LOGO -->
                    <header class="identity-row">

                        <!-- LOGO BPS -->
                        <div class="identity-mark">

                            <div class="symbol-shell">

                                <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg/1280px-Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg.png"
                                    alt="Logo BPS"
                                    class="img-header">

                            </div>


                            <div class="identity-copy">

                                <span class="text-cyan-bps fw-bold">
                                    BADAN PUSAT STATISTIK
                                </span>

                                <span class="text-cyan-bps fw-semibold">
                                    KABUPATEN DAIRI
                                </span>

                            </div>

                        </div>


                        <div></div>


                        <!-- LOGO BERAKHLAK -->
                        <div class="identity-mark right">

                            <div class="symbol-shell">

                                <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Logo_BerAKHLAK.svg/3840px-Logo_BerAKHLAK.svg.png"
                                    alt="Logo BerAKHLAK"
                                    class="img-header"
                                    onerror="this.src='https://via.placeholder.com/120x50?text=BerAKHLAK'">

                            </div>

                        </div>

                    </header>


                    <!-- GARIS PEMBATAS -->
                    <div
                        class="header-divider"
                        aria-hidden="true">
                    </div>


                    <!-- BADGE -->
                    <div class="award-pill">
                        BERAKHLAK AWARD
                    </div>


                    <!-- JUDUL -->
                    <section class="title-block">

                        <h2 class="certificate-title">
                            SERTIFIKAT
                        </h2>

                        <h3 class="certificate-subtitle">
                            PENGHARGAAN
                        </h3>

                        <p
                            id="certificate-number"
                            class="certificate-number">

                            NO. -

                        </p>


                        <div
                            class="title-ornament"
                            aria-hidden="true">

                            <span></span>

                        </div>

                    </section>


                    <!-- PENERIMA -->
                    <section class="recipient-block">

                        <p class="recipient-prefix">
                            diberikan kepada:
                        </p>

                        <p
                            id="cert-nama"
                            class="recipient-name">

                            -

                        </p>

                        <p
                            id="cert-nip"
                            class="recipient-nip">

                            NIP. -

                        </p>

                    </section>


                    <!-- NARASI -->
                    <p class="narrative">

                        sebagai pemenang BerAKHLAK Award
                        untuk core value

                        <strong id="cert-value">
                            -
                        </strong>

                        yang dilaksanakan pada periode

                        <strong id="cert-periode">
                            -
                        </strong>.

                    </p>


                    <!-- TANDA TANGAN -->
                    <section class="signature-block">

                        <p
                            id="cert-place"
                            class="signature-place">

                            Sidikalang, {{ date('d F Y') }}

                        </p>


                        <p
                            id="cert-role-one"
                            class="signature-role">

                            Kepala Badan Pusat Statistik

                        </p>


                        <p
                            id="cert-role-two"
                            class="signature-role">

                            Kabupaten Dairi

                        </p>


                        <div
                            class="signature-space"
                            aria-hidden="true">
                        </div>


                        <p
                            id="cert-ttd-nama"
                            class="signature-name">

                            Joel Roy Perangin-Angin

                        </p>

                    </section>

                </div>

            </article>

        </div>


        <!-- FOOTER MODAL -->
        <div class="modal-footer-modern">

            <button
                type="button"
                class="btn-modern btn-secondary-modern"
                onclick="closePreviewModal()">

                Tutup

            </button>


            <button
                type="button"
                class="btn-modern btn-danger-modern"
                onclick="printSertifikat()">

                <i class="bi bi-printer-fill"></i>
                Cetak / Simpan PDF

            </button>

        </div>

    </div>

</div>


<!-- =============================================================
     CSS
============================================================= -->
<style>

@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap');


:root {
    --bg-app: #f8fafc;
    --card-bg: #ffffff;
    --primary: #4f46e5;
    --primary-hover: #4338ca;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --border-color: #e2e8f0;
    --radius: 8px;
}


/* =========================================================
   BODY
========================================================= */

body {
    background-color: var(--bg-app);
    font-family: 'Lato', sans-serif;
    color: var(--text-main);
}


/* =========================================================
   WRAPPER
========================================================= */

.award-wrapper {
    width: 100%;
    padding: 20px 24px;
    box-sizing: border-box;
}


/* =========================================================
   HEADER
========================================================= */

.page-hero-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    background:
        linear-gradient(
            135deg,
            #4f46e5 0%,
            #3b82f6 100%
        );

    color: white;

    padding: 20px 24px;

    border-radius: var(--radius);

    box-shadow:
        0 4px 6px -1px
        rgba(79, 70, 229, 0.1);

    margin-bottom: 20px;
}


.hero-title-area h2 {
    font-size: 1.4rem;
    font-weight: 700;
    margin: 0 0 4px 0;
}


.hero-title-area p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.9rem;
}


.hero-badge-periode {
    background:
        rgba(255, 255, 255, 0.2);

    padding: 8px 14px;

    border-radius: 20px;

    font-size: 0.85rem;

    backdrop-filter: blur(5px);
}


/* =========================================================
   CARD
========================================================= */

.modern-card {
    background: var(--card-bg);

    border-radius: var(--radius);

    box-shadow:
        0 1px 3px rgba(0, 0, 0, 0.1),
        0 1px 2px rgba(0, 0, 0, 0.06);

    padding: 20px;

    margin-bottom: 20px;

    border: 1px solid var(--border-color);

    width: 100%;

    box-sizing: border-box;
}


.card-body-flex {
    display: flex;

    justify-content: space-between;

    align-items: center;

    flex-wrap: wrap;

    gap: 15px;
}


.badge-label {
    display: inline-block;

    background: #e0e7ff;

    color: #4f46e5;

    padding: 3px 8px;

    border-radius: 4px;

    font-size: 0.75rem;

    font-weight: 700;

    text-transform: uppercase;

    margin-bottom: 6px;
}


.action-info h4 {
    margin: 4px 0;

    font-size: 1.05rem;
}


.meta-stack {
    display: flex;

    flex-direction: column;

    gap: 2px;

    margin-top: 6px;
}


.meta-stack p {
    font-size: 0.9rem;
}


/* =========================================================
   BUTTON
========================================================= */

.btn-modern {
    padding: 8px 16px;

    font-size: 0.9rem;

    font-weight: 600;

    border-radius: 6px;

    cursor: pointer;

    border: none;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    transition: all 0.2s ease;

    font-family: 'Lato', sans-serif;
}


.btn-modern:disabled {
    opacity: 0.7;

    cursor: not-allowed;
}


.btn-primary-modern {
    background-color: var(--primary);

    color: white;
}


.btn-primary-modern:hover {
    background-color: var(--primary-hover);
}


.btn-secondary-modern {
    background-color: #f1f5f9;

    color: var(--text-main);
}


.btn-secondary-modern:hover {
    background-color: #e2e8f0;
}


.btn-danger-modern {
    background-color: #ef4444;

    color: white;
}


.btn-danger-modern:hover {
    background-color: #dc2626;
}


/* =========================================================
   TABLE
========================================================= */

.table-responsive {
    width: 100%;

    overflow-x: auto;
}


.table-modern {
    width: 100%;

    border-collapse: collapse;

    text-align: left;

    font-size: 0.9rem;
}


.table-modern th {
    background-color: #f8fafc;

    color: var(--text-muted);

    font-weight: 700;

    padding: 12px 14px;

    border-bottom: 2px solid var(--border-color);
}


.table-modern td {
    padding: 12px 14px;

    border-bottom: 1px solid var(--border-color);

    vertical-align: middle;
}


.table-modern tbody tr:hover {
    background-color: #f8fafc;
}


/* =========================================================
   CORE TAG
========================================================= */

.core-tag {
    padding: 3px 8px;

    border-radius: 4px;

    font-size: 0.8rem;

    font-weight: 700;
}


.core-tag.kolaboratif {
    background: #e0f2fe;

    color: #0369a1;
}


.core-tag.adaptif {
    background: #fef3c7;

    color: #d97706;
}


.core-tag.loyal {
    background: #fee2e2;

    color: #991b1b;
}


.core-tag.harmonis {
    background: #f3e8ff;

    color: #6b21a8;
}


.core-tag.kompeten {
    background: #d1fae5;

    color: #065f46;
}


.core-tag.akuntabel {
    background: #ffedd5;

    color: #9a3412;
}


/* =========================================================
   RANK
========================================================= */

.rank-badge {
    background: #fef08a;

    color: #854d0e;

    padding: 2px 6px;

    border-radius: 4px;

    font-size: 0.75rem;

    font-weight: 700;
}


/* =========================================================
   WINNER
========================================================= */

.winner-name {
    font-weight: 700;

    color: var(--text-main);
}


.winner-nip {
    font-size: 0.85rem;

    color: var(--text-muted);
}


.code-pill {
    background: #f1f5f9;

    padding: 4px 7px;

    border-radius: 4px;

    font-size: 0.85rem;

    color: #0f172a;

    display: inline-block;
}


/* =========================================================
   MODAL CUSTOM
========================================================= */

.modal-overlay-custom {
    position: fixed;

    inset: 0;

    width: 100%;

    height: 100%;

    background:
        rgba(15, 23, 42, 0.60);

    display: flex;

    justify-content: center;

    align-items: center;

    z-index: 9999;

    padding: 20px;

    box-sizing: border-box;
}


.modal-box {
    background: #ffffff;

    width: 90%;

    max-width: 500px;

    border-radius: var(--radius);

    box-shadow:
        0 20px 40px
        rgba(0, 0, 0, 0.20);

    overflow: hidden;

    max-height: 95vh;
}


.edit-modal-box {
    max-width: 500px;
}


.modal-xl-custom {
    max-width: 1200px;

    width: 96%;
}


.modal-header-modern {
    padding: 14px 18px;

    background: #f8fafc;

    border-bottom: 1px solid var(--border-color);

    display: flex;

    justify-content: space-between;

    align-items: center;
}


.modal-header-modern.dark-header {
    background: #0f172a;

    color: white;
}


.modal-header-modern h6 {
    margin: 0;

    font-weight: 700;

    font-size: 1rem;
}


.close-btn {
    background: none;

    border: none;

    font-size: 1.5rem;

    cursor: pointer;

    color: inherit;

    line-height: 1;
}


.modal-body-modern {
    padding: 20px;
}


.modal-footer-modern {
    padding: 12px 18px;

    background: #f8fafc;

    border-top: 1px solid var(--border-color);

    display: flex;

    justify-content: flex-end;

    gap: 8px;
}


/* =========================================================
   FORM
========================================================= */

.input-group-modern {
    margin-bottom: 14px;

    text-align: left;
}


.input-group-modern label {
    display: block;

    font-size: 0.85rem;

    font-weight: 700;

    margin-bottom: 6px;
}


.form-input {
    width: 100%;

    padding: 9px 12px;

    border: 1px solid var(--border-color);

    border-radius: 6px;

    font-size: 0.9rem;

    font-family: 'Lato', sans-serif;

    box-sizing: border-box;
}


.form-input:focus {
    outline: none;

    border-color: var(--primary);

    box-shadow:
        0 0 0 2px
        rgba(79, 70, 229, 0.1);
}


.form-help {
    font-size: 0.75rem;

    color: var(--text-muted);

    margin-top: 4px;

    display: block;
}


/* =========================================================
   PREVIEW CONTAINER
========================================================= */

.preview-canvas-container {
    background: #cbd5e1;

    padding: 30px;

    max-height: 80vh;

    overflow-y: auto;

    text-align: center;
}


/* =========================================================
   CERTIFICATE
========================================================= */

.certificate {
    position: relative;

    width: 1120px;

    max-width: 100%;

    aspect-ratio: 1.414 / 1;

    margin: 0 auto;

    background:
        linear-gradient(
            135deg,
            #ffffff 0%,
            #f8fafc 100%
        );

    overflow: hidden;

    box-shadow:
        0 15px 40px
        rgba(0, 0, 0, 0.20);

    color: #1e293b;

    font-family: 'Lato', sans-serif;

    box-sizing: border-box;
}


/* =========================================================
   FRAME
========================================================= */

.frame-outer {
    position: absolute;

    inset: 18px;

    border: 3px solid #0f172a;

    pointer-events: none;

    z-index: 2;
}


.frame-middle {
    position: absolute;

    inset: 25px;

    border: 1px solid #d4af37;

    pointer-events: none;

    z-index: 2;
}


.frame-inner {
    position: absolute;

    inset: 32px;

    border: 1px solid rgba(14, 116, 144, 0.35);

    pointer-events: none;

    z-index: 2;
}


/* =========================================================
   CORNER DECORATION
========================================================= */

.corner-tech {
    position: absolute;

    width: 90px;

    height: 90px;

    z-index: 3;
}


.corner-tech::before,
.corner-tech::after {
    content: "";

    position: absolute;

    background: #0891b2;
}


.corner-tech::before {
    width: 60px;

    height: 2px;
}


.corner-tech::after {
    width: 2px;

    height: 60px;
}


.corner-tech span {
    position: absolute;

    width: 8px;

    height: 8px;

    border: 2px solid #d4af37;

    background: white;
}


.corner-tl {
    top: 39px;

    left: 39px;
}


.corner-tl::before {
    top: 0;

    left: 0;
}


.corner-tl::after {
    top: 0;

    left: 0;
}


.corner-tl span {
    top: 15px;

    left: 15px;
}


.corner-tr {
    top: 39px;

    right: 39px;
}


.corner-tr::before {
    top: 0;

    right: 0;
}


.corner-tr::after {
    top: 0;

    right: 0;
}


.corner-tr span {
    top: 15px;

    right: 15px;
}


.corner-br {
    bottom: 39px;

    right: 39px;
}


.corner-br::before {
    bottom: 0;

    right: 0;
}


.corner-br::after {
    bottom: 0;

    right: 0;
}


.corner-br span {
    bottom: 15px;

    right: 15px;
}


.corner-bl {
    bottom: 39px;

    left: 39px;
}


.corner-bl::before {
    bottom: 0;

    left: 0;
}


.corner-bl::after {
    bottom: 0;

    left: 0;
}


.corner-bl span {
    bottom: 15px;

    left: 15px;
}


/* =========================================================
   CIRCUIT
========================================================= */

.circuit {
    position: absolute;

    top: 40%;

    width: 140px;

    height: 180px;

    opacity: 0.45;

    z-index: 1;
}


.circuit-left {
    left: 0;
}


.circuit-right {
    right: 0;

    transform: scaleX(-1);
}


.circuit-line {
    position: absolute;

    display: block;

    height: 1px;

    background: #0891b2;
}


.circuit-line::after {
    content: "";

    position: absolute;

    width: 5px;

    height: 5px;

    border-radius: 50%;

    background: #d4af37;

    top: -2px;
}


.circuit-line.one {
    top: 20px;

    left: 0;

    width: 100px;
}


.circuit-line.one::after {
    right: 0;
}


.circuit-line.two {
    top: 60px;

    left: 0;

    width: 70px;
}


.circuit-line.two::after {
    right: 0;
}


.circuit-line.three {
    top: 100px;

    left: 0;

    width: 120px;
}


.circuit-line.three::after {
    right: 0;
}


/* =========================================================
   ORBIT WATERMARK
========================================================= */

.orbit-watermark {
    position: absolute;

    width: 300px;

    height: 300px;

    border: 1px solid rgba(8, 145, 178, 0.08);

    border-radius: 50%;

    top: 50%;

    left: 50%;

    transform:
        translate(-50%, -50%)
        rotate(-25deg);

    z-index: 0;
}


.orbit-watermark::before {
    content: "";

    position: absolute;

    inset: 25px;

    border:
        1px solid
        rgba(212, 175, 55, 0.10);

    border-radius: 50%;
}


.orbit-core {
    position: absolute;

    width: 25px;

    height: 25px;

    border-radius: 50%;

    background:
        rgba(8, 145, 178, 0.05);

    top: 50%;

    left: 50%;

    transform:
        translate(-50%, -50%);
}


/* =========================================================
   CERTIFICATE CONTENT
========================================================= */

.certificate-content {
    position: absolute;

    inset: 55px;

    z-index: 5;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: space-between;

    text-align: center;
}


/* =========================================================
   IDENTITY
========================================================= */

.identity-row {
    width: 100%;

    display: flex;

    justify-content: space-between;

    align-items: center;
}


.identity-mark {
    display: flex;

    align-items: center;

    gap: 12px;
}


.identity-mark.right {
    justify-content: flex-end;
}


.symbol-shell {
    display: flex;

    align-items: center;

    justify-content: center;
}


.img-header {
    height: 58px;

    width: auto;

    max-width: 160px;

    object-fit: contain;
}


.identity-copy {
    display: flex;

    flex-direction: column;

    align-items: flex-start;

    line-height: 1.3;
}


.text-cyan-bps {
    color: #0284c7;

    font-size: 0.85rem;

    letter-spacing: 1px;
}


.fw-bold {
    font-weight: 700;
}


.fw-semibold {
    font-weight: 600;
}


/* =========================================================
   DIVIDER
========================================================= */

.header-divider {
    width: 100%;

    height: 1px;

    background:
        linear-gradient(
            to right,
            transparent,
            #d4af37,
            transparent
        );

    margin: 4px 0;
}


/* =========================================================
   AWARD PILL
========================================================= */

.award-pill {
    display: inline-block;

    padding: 5px 20px;

    border: 1px solid #d4af37;

    color: #b45309;

    font-size: 0.7rem;

    font-weight: 800;

    letter-spacing: 3px;

    border-radius: 20px;

    background:
        rgba(255, 255, 255, 0.85);
}


/* =========================================================
   TITLE
========================================================= */

.title-block {
    margin-top: 2px;
}


.certificate-title {
    margin: 0;

    font-size: 3.4rem;

    font-weight: 900;

    letter-spacing: 8px;

    color: #0f172a;
}


.certificate-subtitle {
    margin: -4px 0 2px;

    font-size: 1.05rem;

    letter-spacing: 5px;

    color: #64748b;

    font-weight: 700;
}


.certificate-number {
    margin: 5px 0;

    font-size: 0.85rem;

    font-weight: 700;

    color: #475569;

    letter-spacing: 1px;
}


.title-ornament {
    width: 180px;

    height: 2px;

    margin: 5px auto;

    background: #d4af37;

    position: relative;
}


.title-ornament span {
    position: absolute;

    width: 8px;

    height: 8px;

    background: #d4af37;

    left: 50%;

    top: 50%;

    transform:
        translate(-50%, -50%)
        rotate(45deg);
}


/* =========================================================
   RECIPIENT
========================================================= */

.recipient-block {
    margin-top: 0;
}


.recipient-prefix {
    margin: 0 0 3px;

    font-size: 0.9rem;

    font-style: italic;

    color: #64748b;
}


.recipient-name {
    margin: 0;

    font-size: 2rem;

    font-weight: 900;

    color: #0f172a;

    letter-spacing: 0.5px;
}


.recipient-nip {
    margin: 4px 0 0;

    font-size: 0.9rem;

    font-weight: 700;

    color: #475569;
}


/* =========================================================
   NARRATIVE
========================================================= */

.narrative {
    max-width: 720px;

    margin: 0 auto;

    font-size: 0.95rem;

    line-height: 1.6;

    color: #334155;
}


.narrative strong {
    color: #b45309;

    font-weight: 900;
}


/* =========================================================
   SIGNATURE
========================================================= */

.signature-block {
    align-self: flex-end;

    width: 250px;

    text-align: center;

    margin-right: 15px;
}


.signature-place {
    margin: 0 0 3px;

    font-size: 0.78rem;

    color: #475569;
}


.signature-role {
    margin: 0;

    font-size: 0.78rem;

    font-weight: 700;

    color: #1e293b;
}


.signature-space {
    height: 50px;
}


.signature-name {
    margin: 0;

    display: inline-block;

    border-bottom: 1px solid #1e293b;

    padding: 0 10px 2px;

    font-size: 0.9rem;

    font-weight: 900;
}


/* =========================================================
   ALERT
========================================================= */

.alert-modern {
    padding: 10px 14px;

    border-radius: 6px;

    font-size: 0.85rem;

    font-weight: 600;
}


.d-none {
    display: none !important;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .page-hero-header {
        flex-direction: column;

        align-items: flex-start;

        gap: 15px;
    }


    .action-btn-wrapper {
        width: 100%;
    }


    .action-btn-wrapper .btn-modern {
        width: 100%;
    }


    .certificate {
        width: 900px;
    }

}


@media (max-width: 600px) {

    .award-wrapper {
        padding: 12px;
    }


    .modern-card {
        padding: 14px;
    }


    .table-modern {
        min-width: 700px;
    }


    .modal-overlay-custom {
        padding: 10px;
    }


    .modal-xl-custom {
        width: 100%;
    }


    .preview-canvas-container {
        padding: 10px;
    }

}


/* =========================================================
   PRINT
========================================================= */

@media print {

    @page {
        size: A4 landscape;

        margin: 0;
    }


    html,
    body {
        width: 297mm;

        height: 210mm;

        margin: 0 !important;

        padding: 0 !important;

        background: white !important;
    }


    body * {
        visibility: hidden !important;
    }


    #modalSertifikat,
    #modalSertifikat *,
    #cert-print-area,
    #cert-print-area * {
        visibility: visible !important;
    }


    #modalSertifikat {
        position: fixed !important;

        inset: 0 !important;

        width: 100% !important;

        height: 100% !important;

        background: white !important;

        padding: 0 !important;

        margin: 0 !important;

        display: flex !important;

        align-items: flex-start !important;

        justify-content: center !important;
    }


    #modalSertifikat .modal-box {
        width: 100% !important;

        max-width: none !important;

        max-height: none !important;

        box-shadow: none !important;

        border: none !important;

        border-radius: 0 !important;
    }


    #modalSertifikat .modal-header-modern,
    #modalSertifikat .modal-footer-modern {
        display: none !important;
    }


    #modalSertifikat .preview-canvas-container {
        width: 100% !important;

        height: 100% !important;

        max-height: none !important;

        padding: 0 !important;

        background: white !important;

        overflow: visible !important;
    }


    #cert-print-area {
        position: absolute !important;

        top: 0 !important;

        left: 0 !important;

        width: 297mm !important;

        height: 210mm !important;

        max-width: none !important;

        aspect-ratio: auto !important;

        margin: 0 !important;

        padding: 0 !important;

        box-shadow: none !important;

        transform: none !important;
    }


    .certificate-content {
        inset: 15mm !important;
    }

}

</style>

@endsection


@section('scripts')

<script>

/* =============================================================
   DATA PEMENANG
============================================================= */

let listPemenangCache = [

    {
        periode: "2026 06",
        core_value: "Kolaboratif",
        rank: "1",
        nama: "Juando Siallagan, S.Tr.Stat.",
        nip: "340061848",
        no_sertifikat: "-"
    },

    {
        periode: "2026 05",
        core_value: "Adaptif",
        rank: "1",
        nama: "Sangaptua Deo Datus Sagala, S.Tr.Stat.",
        nip: "340059765",
        no_sertifikat: "-"
    },

    {
        periode: "2026 04",
        core_value: "Loyal",
        rank: "1",
        nama: "Mike Ervans Purba, A.Md.Stat.",
        nip: "340062190",
        no_sertifikat: "B-764/1210/TS.220/2026"
    },

    {
        periode: "2026 03",
        core_value: "Harmonis",
        rank: "1",
        nama: "Sangaptua Deo Datus Sagala, S.Tr.Stat.",
        nip: "340059765",
        no_sertifikat: "B-624/1210/TS.220/2026"
    },

    {
        periode: "2026 02",
        core_value: "Kompeten",
        rank: "1",
        nama: "Juando Siallagan, S.Tr.Stat.",
        nip: "340061848",
        no_sertifikat: "B-410/1210/TS.220/2026"
    },

    {
        periode: "2026 01",
        core_value: "Akuntabel",
        rank: "1",
        nama: "Sangaptua Deo Datus Sagala, S.Tr.Stat.",
        nip: "340059765",
        no_sertifikat: "B-208/1210/TS.220/2026"
    }

];


/* =============================================================
   PENETAPAN PEMENANG
============================================================= */

function handlePenetapanPemenang() {

    if (
        !confirm(
            "Apakah Anda yakin ingin melakukan penetapan pemenang periode ini?"
        )
    ) {
        return;
    }


    const btn =
        document.getElementById(
            'btn-trigger-pemenang'
        );


    btn.disabled = true;


    btn.innerHTML =
        '<i class="bi bi-hourglass-split"></i> Memproses...';


    setTimeout(function () {

        btn.disabled = false;


        btn.innerHTML =
            '<i class="bi bi-lightning-charge-fill"></i> Tentukan & Rekam Pemenang';


        showSystemAlert(
            "Pemenang periode 2026 06 berhasil ditetapkan ke sistem!",
            "success"
        );

    }, 1000);

}


/* =============================================================
   BUKA MODAL EDIT
============================================================= */

function openEditNoSertifikat(periode, nip) {

    const target =
        listPemenangCache.find(
            function (p) {

                return (
                    p.periode == periode &&
                    p.nip == nip
                );

            }
        );


    if (!target) {

        alert(
            "Data pemenang tidak ditemukan."
        );

        return;
    }


    document.getElementById(
        'edit-cert-periode'
    ).value = periode;


    document.getElementById(
        'edit-cert-nip'
    ).value = nip;


    document.getElementById(
        'edit-cert-nama'
    ).value =
        target.nama +
        " (NIP: " +
        target.nip +
        ")";


    document.getElementById(
        'edit-cert-nosert'
    ).value =
        target.no_sertifikat !== '-'
            ? target.no_sertifikat
            : '';


    document.getElementById(
        'modalEditNoSertifikat'
    ).style.display = 'flex';

}


/* =============================================================
   TUTUP MODAL EDIT
============================================================= */

function closeEditModal() {

    document.getElementById(
        'modalEditNoSertifikat'
    ).style.display = 'none';

}


/* =============================================================
   SIMPAN NOMOR SERTIFIKAT
============================================================= */

function handleSaveNoSertifikat() {

    const periode =
        document.getElementById(
            'edit-cert-periode'
        ).value;


    const nip =
        document.getElementById(
            'edit-cert-nip'
        ).value;


    const noSertifikat =
        document.getElementById(
            'edit-cert-nosert'
        ).value.trim();


    const target =
        listPemenangCache.find(
            function (p) {

                return (
                    p.periode == periode &&
                    p.nip == nip
                );

            }
        );


    if (!target) {

        alert(
            "Data pemenang tidak ditemukan."
        );

        return;
    }


    /*
     * Jika kosong, gunakan nomor otomatis.
     */
    target.no_sertifikat =
        noSertifikat
            ? noSertifikat
            : "-";


    /*
     * Update tampilan tabel.
     */
    updateNomorSertifikatTable(
        periode,
        target.no_sertifikat
    );


    closeEditModal();


    showSystemAlert(
        "Nomor sertifikat berhasil diperbarui.",
        "success"
    );

}


/* =============================================================
   UPDATE NOMOR DI TABEL
============================================================= */

function updateNomorSertifikatTable(
    periode,
    noSertifikat
) {

    const safePeriode =
        periode.replace(
            /\s/g,
            '-'
        );


    const cell =
        document.getElementById(
            'sertifikat-' + safePeriode
        );


    if (!cell) {
        return;
    }


    if (noSertifikat === '-') {

        cell.innerHTML =
            '<span class="text-italic text-muted">' +
            'Otomatis System' +
            '</span>';

    } else {

        cell.innerHTML =
            '<code class="code-pill">' +
            escapeHtml(noSertifikat) +
            '</code>';

    }

}


/* =============================================================
   PREVIEW SERTIFIKAT
============================================================= */

function previewSertifikat(
    periode,
    nip
) {

    const target =
        listPemenangCache.find(
            function (p) {

                return (
                    p.periode == periode &&
                    p.nip == nip
                );

            }
        );


    if (!target) {

        alert(
            "Data pemenang tidak ditemukan."
        );

        return;
    }


    /*
     * Nomor sertifikat
     */
    document.getElementById(
        'certificate-number'
    ).innerText =
        "NO. " +
        (
            target.no_sertifikat !== '-'
                ? target.no_sertifikat
                : 'Otomatis System'
        );


    /*
     * Nama
     */
    document.getElementById(
        'cert-nama'
    ).innerText =
        target.nama;


    /*
     * NIP
     */
    document.getElementById(
        'cert-nip'
    ).innerText =
        "NIP. " +
        target.nip;


    /*
     * Core Value
     */
    document.getElementById(
        'cert-value'
    ).innerText =
        target.core_value;


    /*
     * Periode
     */
    document.getElementById(
        'cert-periode'
    ).innerText =
        target.periode;


    /*
     * Buka modal
     */
    document.getElementById(
        'modalSertifikat'
    ).style.display = 'flex';

}


/* =============================================================
   TUTUP PREVIEW
============================================================= */

function closePreviewModal() {

    document.getElementById(
        'modalSertifikat'
    ).style.display = 'none';

}


/* =============================================================
   CETAK SERTIFIKAT
============================================================= */

function printSertifikat() {

    window.print();

}


/* =============================================================
   ALERT SISTEM
============================================================= */

function showSystemAlert(
    message,
    type
) {

    const alertBox =
        document.getElementById(
            'pemenang-alert'
        );


    alertBox.className =
        'alert-modern ' +
        (
            type === 'success'
                ? 'bg-success text-white'
                : 'bg-danger text-white'
        );


    alertBox.style.backgroundColor =
        type === 'success'
            ? '#10b981'
            : '#ef4444';


    alertBox.style.color = '#fff';


    alertBox.innerText =
        message;


    alertBox.classList.remove(
        'd-none'
    );


    setTimeout(
        function () {

            alertBox.classList.add(
                'd-none'
            );

        },
        4000
    );

}


/* =============================================================
   ESCAPE HTML
============================================================= */

function escapeHtml(value) {

    const div =
        document.createElement('div');


    div.textContent =
        value;


    return div.innerHTML;

}


/* =============================================================
   TUTUP MODAL KETIKA KLIK AREA LUAR
============================================================= */

document.addEventListener(
    'click',
    function (event) {

        const editModal =
            document.getElementById(
                'modalEditNoSertifikat'
            );


        const previewModal =
            document.getElementById(
                'modalSertifikat'
            );


        if (
            event.target === editModal
        ) {

            closeEditModal();

        }


        if (
            event.target === previewModal
        ) {

            closePreviewModal();

        }

    }
);


/* =============================================================
   ESC UNTUK MENUTUP MODAL
============================================================= */

document.addEventListener(
    'keydown',
    function (event) {

        if (event.key !== 'Escape') {
            return;
        }


        const editModal =
            document.getElementById(
                'modalEditNoSertifikat'
            );


        const previewModal =
            document.getElementById(
                'modalSertifikat'
            );


        if (
            editModal &&
            editModal.style.display === 'flex'
        ) {

            closeEditModal();

        }


        if (
            previewModal &&
            previewModal.style.display === 'flex'
        ) {

            closePreviewModal();

        }

    }
);

</script>

@endsection
