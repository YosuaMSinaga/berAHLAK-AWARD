{{-- HEADER INFORMASI PROFIL & HEADING --}}
<div class="custom-card mb-4">
    <div class="card-header-custom">
        <h5 id="personal-heading">👤 Laporan Kompetensi Perilaku</h5>
    </div>
    <p class="text-muted mb-0">Berikut adalah rekam jejak performa dan evaluasi mandiri serta rekan sejawat Anda berdasarkan periode penilaian.</p>
</div>

{{-- REKAP NILAI RERATA PRIBADI --}}
<div class="custom-card" id="recap-personal-scores-container">
    <div class="card-header-custom">
        <h5>🏆 Rata-Rata Capaian Perilaku Pribadi</h5>
    </div>
    <div class="recap-grid">
        <div class="recap-box">
            <span class="muted-label">Rata-Rata Skor Self</span>
            <h3 id="pribadi-avg-b">0.00%</h3>
        </div>
        <div class="recap-box">
            <span class="muted-label">Rata-Rata Skor Peer</span>
            <h3 id="pribadi-avg-r">0.00%</h3>
        </div>
        <div class="recap-box">
            <span class="muted-label">Rata-Rata Skor Akhir</span>
            <h3 id="pribadi-avg-akhir">0.00%</h3>
        </div>
        <div class="recap-box">
            <span class="muted-label">Status Arsip</span>
            <h3 class="text-success fs-5">Aktif</h3>
        </div>
    </div>
</div>

{{-- GRAFIK TREN LINIER PRIBADI --}}
<div class="custom-card" id="pribadi-chart-container">
    <div class="card-header-custom">
        <h5>📈 Grafik Tren Historis Kompetensi Perilaku</h5>
    </div>
    <div class="chart-big-container">
        <canvas id="chartTrenPribadi"></canvas>
    </div>
</div>

{{-- DAFTAR TIKET RIWAYAT PERIODE --}}
<div class="custom-card">
    <div class="card-header-custom">
        <h5>🎫 Arsip Tiket Penilaian Per Periode</h5>
    </div>
    <div id="personal-ticket-list" class="ticket-list-wrapper">
        <div class="text-center text-muted p-4">
            <span class="spinner-border spinner-border-sm me-2"></span>Memuat riwayat tiket penilaian...
        </div>
    </div>
</div>

{{-- Styling Tambahan Khusus Tampilan Tiket & Layout Pribadi --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700;900&display=swap');

    body,
    .custom-card,
    .custom-select,
    .info-badge-box,
    .muted-label,
    h1, h2, h3, h4, h5, h6,
    p, span, strong, label, select, option,
    .ticket-container,
    .ticket-left-zone,
    .ticket-right-zone {
        font-family: 'Lato', sans-serif;
    }

    .ticket-container {
        display: flex;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        margin-bottom: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .ticket-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important;
    }
    .ticket-left-zone {
        width: 140px;
        flex-shrink: 0;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }
    .ticket-right-zone {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .tracking-wider {
        letter-spacing: 0.05em;
        font-size: 0.7rem;
    }
    .hidden {
        display: none !important;
    }
</style>