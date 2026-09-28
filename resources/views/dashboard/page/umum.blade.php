<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700;900&display=swap');

    body,
    body * {
        font-family: 'Lato', 'Segoe UI', sans-serif !important;
    }
</style>

{{-- FILTER & INFO PERIODE --}}
<div class="custom-card filter-card">
    <div class="filter-grid">
        <div class="form-group-custom">
            <label for="dash-filter-periode-umum">
                Pilih Periode Analisis
            </label>
            <div class="input-icon-wrapper">
                <span>📁</span>
                <select
                    id="dash-filter-periode-umum"
                    onchange="changeDashboardUmumPeriod()"
                    class="custom-select"
                >
                    {{-- Opsi periode dimuat lewat JavaScript --}}
                </select>
            </div>
        </div>
        <div class="info-badge-box">
            <span>Core Value Aktif Periode Ini</span>
            <strong id="dash-txt-value-aktif">-</strong>
        </div>
    </div>
</div>

{{-- PROGRES PENGISIAN & STATISTIK --}}
<div class="stats-main-grid">
    <div class="custom-card chart-progres-card mb-0">
        <div class="card-inner-flex">
            <h5>Rasio Progres Pengisian</h5>
            <div class="canvas-container">
                <canvas id="chartProgres"></canvas>
            </div>
            <div id="dashboard-persen-isi" class="persen-label">
                0% Selesai
            </div>
        </div>
    </div>

    <div class="stats-sub-grid">
        <div class="custom-card stat-item border-green mb-0">
            <div class="stat-content">
                <div class="stat-icon green">✓</div>
                <div class="stat-text">
                    <span>Sudah Mengisi</span>
                    <h3 id="dash-count-sudah">0</h3>
                </div>
            </div>
        </div>
        <div class="custom-card stat-item border-orange mb-0">
            <div class="stat-content">
                <div class="stat-icon orange">!</div>
                <div class="stat-text">
                    <span>Belum Mengisi</span>
                    <h3 id="dash-count-belum">0</h3>
                </div>
            </div>
        </div>
        <div class="custom-card stat-item border-blue mb-0">
            <div class="stat-content">
                <div class="stat-icon blue">👥</div>
                <div class="stat-text">
                    <span>Total Pegawai</span>
                    <h3 id="dash-count-total">0</h3>
                </div>
            </div>
        </div>
        <div class="custom-card stat-item border-purple mb-0">
            <div class="stat-content">
                <div class="stat-icon purple">⏳</div>
                <div class="stat-text">
                    <span>Periode Aktif</span>
                    <h6 id="dash-txt-periode">-</h6>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- REKAP NILAI --}}
<div class="custom-card" id="recap-scores-container">
    <div class="card-header-custom">
        <h5>🏆 Capaian Nilai BPS Kabupaten Dairi</h5>
    </div>
    <div class="recap-grid">
        <div class="recap-box">
            <span class="muted-label">Wawasan BerAKHLAK</span>
            <h3 id="avg-skor-berakhlak">0.00</h3>
        </div>
        <div class="recap-box">
            <span class="muted-label">Penerapan BerAKHLAK</span>
            <h3 id="avg-skor-rekan">0.00</h3>
        </div>
        <div class="recap-box">
            <span class="muted-label">Skor Akhir</span>
            <h3 id="avg-skor-akhir">0.00</h3>
        </div>
        <div class="recap-box">
            <span class="muted-label">Nilai Korelasi (R)</span>
            <h3 id="avg-korelasi-r">0.0000</h3>
        </div>
    </div>
</div>

{{-- CHART VALUE --}}
<div class="custom-card" id="umum-chart-value-container">
    <div class="card-header-custom">
        <h5>📈 Analisis Keterpilihan Implementasi BerAKHLAK di Organisasi (%)</h5>
    </div>
    <div class="chart-big-container">
        <canvas id="chartValueUmum"></canvas>
    </div>
</div>

{{-- MONITORING PEGAWAI --}}
<div class="custom-card">
    <div class="card-header-custom">
        <h5>📋 Daftar Pemantauan Pengisian Pegawai</h5>
    </div>
    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama Pegawai</th>
                    <th>Status Respon</th>
                </tr>
            </thead>
            <tbody id="table-progres-body">
                <tr>
                    <td colspan="3" class="text-center-custom">
                        <div class="spinner-custom" role="status"></div>
                        Memuat log pemantauan...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>