@php
    $isAdmin = auth()->user()->role === 'admin';

    $urlPeriode = $isAdmin
        ? route('dashboard.periode')
        : route('user.dashboard.periode');

    $urlData = $isAdmin
        ? route('dashboard.data')
        : route('user.dashboard.data');
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;400;500;600;700;900&display=swap');

    /* =========================================================
       MODERN DASHBOARD ROOT STYLING
    ========================================================= */
    .dashboard-wrapper,
    .dashboard-wrapper * {
        font-family: 'Lato', sans-serif !important;
        box-sizing: border-box;
    }

    /* Custom Modern Card Style */
    .custom-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        padding: 24px;
        margin-bottom: 24px;
        transition: all 0.3s ease;
    }

    .custom-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
    }

    /* Filter Card & Grid */
    .filter-grid {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .form-group-custom {
        width: 100%;
        max-width: 100%;
    }

    .form-group-custom label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .input-icon-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .custom-select {
        width: 100%;
        padding: 12px 45px 12px 20px;
        background-color: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .select-arrow-icon {
        position: absolute;
        right: 16px;
        pointer-events: none;
        color: #64748b;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-select option {
        text-align: left;
    }

    .custom-select:focus {
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    .info-badge-box {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid #bfdbfe;
        padding: 12px 20px;
        border-radius: 12px;
        text-align: right;
    }

    .info-badge-box span {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #1d4ed8;
        letter-spacing: 0.05em;
    }

    .info-badge-box strong {
        font-size: 15px;
        font-weight: 800;
        color: #1e3a8a;
    }

    /* Stats Main Grid */
    .stats-main-grid {
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) {
        .stats-main-grid {
            grid-template-columns: 1fr;
        }
    }

    .stats-sub-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    @media (max-width: 640px) {
        .stats-sub-grid {
            grid-template-columns: 1fr;
        }
    }

    .stat-item {
        padding: 20px;
        border-radius: 14px;
        border-left: 4px solid #cbd5e1;
        margin-bottom: 0 !important;
        display: flex;
        align-items: center;
    }

    .stat-item.border-green { border-left-color: #10b981; background: linear-gradient(to right, rgba(16, 185, 129, 0.03), transparent); }
    .stat-item.border-orange { border-left-color: #f97316; background: linear-gradient(to right, rgba(249, 115, 22, 0.03), transparent); }
    .stat-item.border-blue { border-left-color: #3b82f6; background: linear-gradient(to right, rgba(59, 130, 246, 0.03), transparent); }
    .stat-item.border-purple { border-left-color: #8b5cf6; background: linear-gradient(to right, rgba(139, 92, 246, 0.03), transparent); }

    .stat-content {
        display: flex;
        align-items: center;
        gap: 16px;
        width: 100%;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        flex-shrink: 0;
    }

    .stat-icon.green { background: #d1fae5; color: #047857; }
    .stat-icon.orange { background: #ffedd5; color: #c2410c; }
    .stat-icon.blue { background: #dbeafe; color: #1d4ed8; }
    .stat-icon.purple { background: #ede9fe; color: #6d28d9; }

    .stat-text span {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 4px;
    }

    .stat-text h3, .stat-text h6 {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .stat-text h6 {
        font-size: 15px;
    }

    /* Card Headers & Layout */
    .card-header-custom h5 {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 16px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Chart Containers */
    .chart-progres-card .canvas-container {
        position: relative;
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 10px 0;
    }

    .persen-label {
        text-align: center;
        font-weight: 800;
        color: #334155;
        font-size: 15px;
        margin-top: 8px;
    }

    .chart-big-container {
        position: relative;
        width: 100%;
        min-height: 300px;
        height: 300px;
    }

    /* Recap Grid */
    .recap-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    @media (max-width: 1024px) {
        .recap-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .recap-grid {
            grid-template-columns: 1fr;
        }
    }

    .recap-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
    }

    .recap-box .muted-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 8px;
        letter-spacing: 0.025em;
    }

    .recap-box h3 {
        font-size: 24px;
        font-weight: 900;
        color: #0f172a;
        margin: 0;
    }

    /* Table Styling */
    .table-container {
        overflow-x: auto;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 14px;
    }

    .custom-table th {
        background-color: #f1f5f9;
        color: #334155;
        font-weight: 800;
        padding: 14px 18px;
        border-bottom: 1px solid #e2e8f0;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.05em;
    }

    .custom-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        font-weight: 500;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .text-center-custom {
        text-align: center;
        color: #64748b;
        padding: 30px !important;
    }

    /* Spinner */
    .spinner-custom {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(59, 130, 246, 0.2);
        border-radius: 50%;
        border-top-color: #3b82f6;
        animation: spin 0.8s linear infinite;
        margin-right: 8px;
        vertical-align: middle;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="dashboard-wrapper">

    {{-- =========================================================
         FILTER & INFO PERIODE
    ========================================================= --}}
    <div class="custom-card">
        <div class="filter-grid">
            <div class="form-group-custom">
                <label for="dash-filter-periode-umum">Pilih Periode Analisis</label>
                <div class="input-icon-wrapper">
                    <select
                        id="dash-filter-periode-umum"
                        onchange="changeDashboardUmumPeriod()"
                        class="custom-select"
                        required
                    >
                        <option value="" disabled selected hidden>-- Pilih Periode Analisis --</option>
                    </select>
                    <div class="select-arrow-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="info-badge-box">
                <span>Core Value Aktif Periode Ini</span>
                <strong id="dash-txt-value-aktif">-</strong>
            </div>
        </div>
    </div>


    {{-- =========================================================
         PROGRES PENGISIAN & STATISTIK
    ========================================================= --}}
    <div class="stats-main-grid">
        {{-- CHART PROGRES --}}
        <div class="custom-card chart-progres-card mb-0" style="margin-bottom:0;">
            <div class="card-inner-flex">
                <h5 style="font-size:15px; font-weight:800; color:#0f172a; margin-bottom:12px;">Rasio Progres Pengisian</h5>
                <div class="canvas-container">
                    <canvas id="chartProgres"></canvas>
                </div>
                <div id="dashboard-persen-isi" class="persen-label">0% Selesai</div>
            </div>
        </div>

        {{-- STATISTIK --}}
        <div class="stats-sub-grid">
            <div class="custom-card stat-item border-green mb-0" style="margin-bottom:0;">
                <div class="stat-content">
                    <div class="stat-icon green">✓</div>
                    <div class="stat-text">
                        <span>Sudah Mengisi</span>
                        <h3 id="dash-count-sudah">0</h3>
                    </div>
                </div>
            </div>

            <div class="custom-card stat-item border-orange mb-0" style="margin-bottom:0;">
                <div class="stat-content">
                    <div class="stat-icon orange">!</div>
                    <div class="stat-text">
                        <span>Belum Mengisi</span>
                        <h3 id="dash-count-belum">0</h3>
                    </div>
                </div>
            </div>

            <div class="custom-card stat-item border-blue mb-0" style="margin-bottom:0;">
                <div class="stat-content">
                    <div class="stat-icon blue">👥</div>
                    <div class="stat-text">
                        <span>Total Pegawai</span>
                        <h3 id="dash-count-total">0</h3>
                    </div>
                </div>
            </div>

            <div class="custom-card stat-item border-purple mb-0" style="margin-bottom:0;">
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


    {{-- =========================================================
         REKAP NILAI
    ========================================================= --}}
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


    {{-- =========================================================
         CHART VALUE / IMPLEMENTASI BERAKHLAK
    ========================================================= --}}
    <div class="custom-card" id="umum-chart-value-container">
        <div class="card-header-custom">
            <h5>📈 Analisis Keterpilihan Implementasi BerAKHLAK di Organisasi (%)</h5>
        </div>
        <div class="chart-big-container">
            <canvas id="chartValueUmum"></canvas>
        </div>
    </div>


    {{-- =========================================================
         MONITORING PEGAWAI
    ========================================================= --}}
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

</div>


{{-- =========================================================
     CHART.JS CDN
========================================================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


{{-- =========================================================
     SCRIPT DASHBOARD
========================================================= --}}
@push('scripts')
<script>
/* URL disesuaikan otomatis dengan role (admin / user) */
const DASH_URL_PERIODE = @json($urlPeriode);
const DASH_URL_DATA    = @json($urlData);

const DASH_FETCH_OPTIONS = {
    method: 'GET',
    credentials: 'same-origin',
    headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
};

document.addEventListener('DOMContentLoaded', function () {
    loadDashboardPeriode();
});

/* =========================================================
   LOAD DAFTAR PERIODE
========================================================= */
function loadDashboardPeriode() {
    const select = document.getElementById('dash-filter-periode-umum');
    if (!select) return;

    select.innerHTML = '<option value="" disabled selected hidden>Memuat periode...</option>';

    fetch(DASH_URL_PERIODE, DASH_FETCH_OPTIONS)
    .then(function (res) {
        if (!res.ok) {
            throw new Error('Gagal mengambil daftar periode (HTTP ' + res.status + ').');
        }
        return res.json();
    })
    .then(function (data) {
        select.innerHTML = '<option value="" disabled hidden>-- Pilih Periode Analisis --</option>';

        if (!data || !Array.isArray(data.periode) || data.periode.length === 0) {
            select.innerHTML = '<option value="" disabled selected>Belum ada periode tersedia</option>';
            resetDashboard();
            return;
        }

        data.periode.forEach(function (periode) {
            const option = document.createElement('option');
            option.value = periode;
            option.textContent = periode;
            select.appendChild(option);
        });

        if (data.periode.length > 0) {
            select.value = data.periode[0];
            changeDashboardUmumPeriod();
        }
    })
    .catch(function (error) {
        console.error('Error load periode:', error);
        select.innerHTML = '<option value="" disabled selected>Gagal memuat periode</option>';
        resetDashboard();
    });
}

/* =========================================================
   GANTI PERIODE
========================================================= */
function changeDashboardUmumPeriod() {
    const select = document.getElementById('dash-filter-periode-umum');
    if (!select) return;

    const periode = select.value;
    if (!periode) {
        resetDashboard();
        return;
    }

    setText('dash-txt-periode', periode);
    loadDashboardByPeriode(periode);
}

/* =========================================================
   LOAD DATA DASHBOARD BERDASARKAN PERIODE
========================================================= */
function loadDashboardByPeriode(periode) {
    const tableBody = document.getElementById('table-progres-body');
    if (tableBody) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="3" class="text-center-custom">
                    <div class="spinner-custom" role="status"></div>
                    Memuat data periode ${escapeHtml(periode)}...
                </td>
            </tr>
        `;
    }

    const url = DASH_URL_DATA + "?periode=" + encodeURIComponent(periode);

    fetch(url, DASH_FETCH_OPTIONS)
    .then(function (res) {
        if (!res.ok) {
            throw new Error('Gagal mengambil data dashboard (HTTP ' + res.status + ').');
        }
        return res.json();
    })
    .then(function (data) {
        updateDashboard(data);
    })
    .catch(function (error) {
        console.error('Error dashboard:', error);
        if (tableBody) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center-custom">
                        Gagal memuat data.
                    </td>
                </tr>
            `;
        }
    });
}

/* =========================================================
   UPDATE SELURUH DASHBOARD
========================================================= */
function updateDashboard(data) {
    setText('dash-count-sudah', data.sudah_mengisi ?? 0);
    setText('dash-count-belum', data.belum_mengisi ?? 0);
    setText('dash-count-total', data.total_pegawai ?? 0);

    const persentase = Number(data.persentase) || 0;
    setText('dashboard-persen-isi', persentase + '% Selesai');
    setText('dash-txt-periode', data.periode ?? '-');
    setText('dash-txt-value-aktif', data.core_value_aktif ?? '-');
    setText('avg-skor-berakhlak', formatNumber(data.avg_skor_berakhlak, 2));
    setText('avg-skor-rekan', formatNumber(data.avg_skor_rekan, 2));
    setText('avg-skor-akhir', formatNumber(data.avg_skor_akhir, 2));
    setText('avg-korelasi-r', formatNumber(data.korelasi_r, 4));

    renderMonitoringTable(data.pegawai || []);
    renderProgressChart(persentase);
    renderValueChart(data.chart_value || []);
}

/* =========================================================
   MONITORING PEGAWAI
========================================================= */
function renderMonitoringTable(pegawai) {
    const tbody = document.getElementById('table-progres-body');
    if (!tbody) return;

    tbody.innerHTML = '';

    if (!Array.isArray(pegawai) || pegawai.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="3" class="text-center-custom">
                    Tidak ada data pegawai pada periode ini.
                </td>
            </tr>
        `;
        return;
    }

    pegawai.forEach(function (item) {
        const row = document.createElement('tr');
        const nip = item.nip ?? '-';
        const nama = item.nama ?? '-';
        const status = normalizeStatus(item.status_isi);
        const isSudah = status === 'sudah';

        const statusHtml = `
            <span style="
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 5px 12px;
                border-radius: 999px;
                background: ${isSudah ? '#ecfdf5' : '#fff7ed'};
                color: ${isSudah ? '#047857' : '#c2410c'};
                font-size: 12px;
                font-weight: 700;
            ">
                ${isSudah ? '✓ Sudah Mengisi' : '! Belum Mengisi'}
            </span>
        `;

        row.innerHTML = `
            <td>${escapeHtml(nip)}</td>
            <td>${escapeHtml(nama)}</td>
            <td>${statusHtml}</td>
        `;

        tbody.appendChild(row);
    });
}

/* =========================================================
   NORMALIZE STATUS
========================================================= */
function normalizeStatus(status) {
    if (status === null || status === undefined) {
        return 'belum';
    }

    const val = String(status).trim().toLowerCase();

    return [
        'sudah',
        'sudah mengisi',
        'isi',
        'terisi',
        '1',
        'true'
    ].includes(val) ? 'sudah' : 'belum';
}

/* =========================================================
   CHART PROGRES PENGISIAN (DOUGHNUT)
========================================================= */
function renderProgressChart(persentase) {
    if (typeof Chart === 'undefined') return;

    const canvas = document.getElementById('chartProgres');
    if (!canvas) return;

    if (window.dashboardProgressChart) {
        window.dashboardProgressChart.destroy();
        window.dashboardProgressChart = null;
    }

    persentase = Math.max(0, Math.min(100, Number(persentase) || 0));
    const belumPersen = 100 - persentase;

    setText('dashboard-persen-isi', persentase + '% Selesai');

    window.dashboardProgressChart = new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: ['Sudah Mengisi', 'Belum Mengisi'],
            datasets: [{
                data: [persentase, belumPersen],
                backgroundColor: ['#10b981', '#f97316'],
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 4,
                cutout: '75%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                animateRotate: true,
                animateScale: true
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        font: {
                            family: 'Lato',
                            size: 12,
                            weight: '600'
                        },
                        color: '#475569'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { family: 'Lato', size: 13, weight: '700' },
                    bodyFont: { family: 'Lato', size: 12, weight: '500' },
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function (ctx) {
                            return ` ${ctx.label}: ${ctx.raw}%`;
                        }
                    }
                }
            }
        }
    });
}

/* =========================================================
   CHART VALUE / IMPLEMENTASI BERAKHLAK (HORIZONTAL BAR)
========================================================= */
function renderValueChart(data) {
    if (typeof Chart === 'undefined') return;

    const canvas = document.getElementById('chartValueUmum');
    if (!canvas) return;

    if (window.dashboardValueChart) {
        window.dashboardValueChart.destroy();
        window.dashboardValueChart = null;
    }

    if (!Array.isArray(data) || data.length === 0) {
        setValueChartHeight([]);
        return;
    }

    setValueChartHeight(data);

    const labels = data.map(function (item) {
        return item.implementasi ?? item.label ?? '-';
    });

    const values = data.map(function (item) {
        const value = Number(item.persentase ?? item.value);
        return Number.isFinite(value) ? value : 0;
    });

    window.dashboardValueChart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Persentase (%)',
                data: values,
                backgroundColor: '#3b82f6',
                borderRadius: 6,
                borderSkipped: false,
                barThickness: 24,
                maxBarThickness: 28
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    min: 0,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Persentase (%)',
                        font: { family: 'Lato', size: 12, weight: '700' },
                        color: '#475569'
                    },
                    ticks: {
                        stepSize: 10,
                        callback: function (value) { return value + '%'; },
                        font: { family: 'Lato', size: 11 }
                    },
                    grid: { color: '#f1f5f9' }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        autoSkip: false,
                        font: { family: 'Lato', size: 12, weight: '600' },
                        color: '#334155'
                    },
                    grid: { display: false }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { family: 'Lato', size: 13, weight: '700' },
                    bodyFont: { family: 'Lato', size: 12, weight: '500' },
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function (ctx) {
                            return ' Persentase: ' + ctx.raw + '%';
                        }
                    }
                }
            }
        }
    });
}

/* =========================================================
   MENYESUAIKAN TINGGI CHART IMPLEMENTASI
========================================================= */
function setValueChartHeight(data) {
    const container = document.querySelector('#umum-chart-value-container .chart-big-container');
    if (!container) return;

    const jumlah = Array.isArray(data) ? data.length : 0;
    const tinggi = Math.max(300, jumlah * 45);
    container.style.height = tinggi + 'px';
}

/* =========================================================
   RESET DASHBOARD
========================================================= */
function resetDashboard() {
    setText('dash-count-sudah', 0);
    setText('dash-count-belum', 0);
    setText('dash-count-total', 0);
    setText('dashboard-persen-isi', '0% Selesai');
    setText('dash-txt-periode', '-');
    setText('dash-txt-value-aktif', '-');
    setText('avg-skor-berakhlak', '0.00');
    setText('avg-skor-rekan', '0.00');
    setText('avg-skor-akhir', '0.00');
    setText('avg-korelasi-r', '0.0000');

    const tbody = document.getElementById('table-progres-body');
    if (tbody) {
        tbody.innerHTML = `
            <tr>
                <td colspan="3" class="text-center-custom">
                    Belum ada periode yang dipilih.
                </td>
            </tr>
        `;
    }

    if (window.dashboardProgressChart) {
        window.dashboardProgressChart.destroy();
        window.dashboardProgressChart = null;
    }

    if (window.dashboardValueChart) {
        window.dashboardValueChart.destroy();
        window.dashboardValueChart = null;
    }

    setValueChartHeight([]);
}

/* =========================================================
   SET TEXT & FORMATTING
========================================================= */
function setText(id, value) {
    const el = document.getElementById(id);
    if (el) {
        el.textContent = value ?? '-';
    }
}

function formatNumber(value, decimal = 2) {
    const num = Number(value);
    return Number.isFinite(num) ? num.toFixed(decimal) : Number(0).toFixed(decimal);
}

function escapeHtml(value) {
    return String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}
</script>
@endpush