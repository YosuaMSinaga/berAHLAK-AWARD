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
            <span class="muted-label">Wawasan BerAKHLAK</span>
            <h3 id="pribadi-avg-b">0.00%</h3>
        </div>
        <div class="recap-box">
            <span class="muted-label">Penerapan BerAKHLAK</span>
            <h3 id="pribadi-avg-r">0.00%</h3>
        </div>
        <div class="recap-box">
            <span class="muted-label">Rata-rata Skor Akhir</span>
            <h3 id="pribadi-avg-akhir">0.00%</h3>
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

    .chart-big-container {
        position: relative;
        height: 340px;
    }

    .ticket-container {
        display: flex;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        margin-bottom: 12px;
        border: 1px solid #e9ecef;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .ticket-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important;
    }
    .ticket-left-zone {
        width: 140px;
        flex-shrink: 0;
        padding: 14px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #0d6efd;
        color: #fff;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }
    .ticket-right-zone {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        padding: 14px 18px;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .ticket-score-item h6 {
        margin: 2px 0 0;
        font-weight: 900;
    }
    .tracking-wider {
        letter-spacing: 0.05em;
        font-size: 0.7rem;
    }
    .hidden {
        display: none !important;
    }
    @media (max-width: 576px) {
        .ticket-container { flex-direction: column; }
        .ticket-left-zone { width: 100%; border-radius: 8px 8px 0 0; }
    }
</style>

{{-- Chart.js (hapus jika sudah dimuat di layout) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    /**
     * Panggil renderLaporanPribadi(data) setelah data dari API/AJAX diterima.
     * Format data: array dari item per periode, contoh:
     * [
     *   { periode: '2023', skor_self: 82.5, skor_peer: 78.0, skor_akhir: 80.2 },
     *   { periode: '2024', skor_self: 85.0, skor_peer: 81.5, skor_akhir: 83.2 }
     * ]
     */
    let chartTrenPribadi = null;

    const fmt = (n) => {
        const value = Number(n) || 0;
        return Number.isInteger(value) ? value + '%' : value.toFixed(2) + '%';
    };
    const avg = (arr, key) =>
        arr.length ? arr.reduce((s, x) => s + (Number(x[key]) || 0), 0) / arr.length : 0;

    function renderLaporanPribadi(data) {
        data = [...data].sort((a, b) => String(a.periode).localeCompare(String(b.periode), undefined, { numeric: true }));

        // 1. Rekap rata-rata
        document.getElementById('pribadi-avg-b').textContent     = fmt(avg(data, 'skor_self'));  // Wawasan BerAKHLAK
        document.getElementById('pribadi-avg-r').textContent     = fmt(avg(data, 'skor_peer'));  // Penerapan BerAKHLAK
        document.getElementById('pribadi-avg-akhir').textContent = fmt(avg(data, 'skor_akhir')); // Rata-rata Skor Akhir

        // 2. Line chart dengan marker
        const ctx = document.getElementById('chartTrenPribadi').getContext('2d');
        if (chartTrenPribadi) chartTrenPribadi.destroy();

        const makeDataset = (label, key, color) => ({
            label,
            data: data.map(d => Number(d[key]) || 0),
            borderColor: color,
            backgroundColor: color,
            borderWidth: 2.5,
            tension: 0.3,
            fill: false,
            pointStyle: 'circle',
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: '#fff',
            pointBorderColor: color,
            pointBorderWidth: 2.5
        });

        chartTrenPribadi = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(d => d.periode),
                datasets: [
                    makeDataset('Skor Self', 'skor_self', '#0d6efd'),
                    makeDataset('Skor Peer', 'skor_peer', '#fd7e14'),
                    makeDataset('Skor Akhir', 'skor_akhir', '#198754')
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true } },
                    tooltip: { callbacks: { label: c => `${c.dataset.label}: ${fmt(c.parsed.y)}` } }
                },
                scales: {
                    y: { beginAtZero: true, suggestedMax: 100, ticks: { callback: v => v + '%' } }
                }
            }
        });

        // 3. Arsip tiket per periode (terbaru di atas)
        const wrapper = document.getElementById('personal-ticket-list');
        if (!data.length) {
            wrapper.innerHTML = '<div class="text-center text-muted p-4">Belum ada riwayat penilaian.</div>';
            return;
        }
        wrapper.innerHTML = [...data].reverse().map(d => `
            <div class="ticket-container shadow-sm">
                <div class="ticket-left-zone">
                    <span class="tracking-wider text-uppercase" style="opacity:.8">Periode</span>
                    <strong class="fs-5">${d.periode}</strong>
                </div>
                <div class="ticket-right-zone">
                    <div class="ticket-score-item">
                        <span class="muted-label tracking-wider text-uppercase">Skor Self</span>
                        <h6>${fmt(d.skor_self)}</h6>
                    </div>
                    <div class="ticket-score-item">
                        <span class="muted-label tracking-wider text-uppercase">Skor Peer</span>
                        <h6>${fmt(d.skor_peer)}</h6>
                    </div>
                    <div class="ticket-score-item">
                        <span class="muted-label tracking-wider text-uppercase">Skor Akhir</span>
                        <h6>${fmt(d.skor_akhir)}</h6>
                    </div>
                </div>
            </div>
        `).join('');
    }

    async function loadLaporanPribadi() {
        try {
            const res = await fetch("{{ route('dashboard.laporan-pribadi') }}", {
                headers: { 'Accept': 'application/json' }
            });
            const json = await res.json();

            if (!json.success) throw new Error(json.message || 'Gagal memuat data');

            renderLaporanPribadi(json.riwayat);
        } catch (err) {
            document.getElementById('personal-ticket-list').innerHTML =
                `<div class="text-center text-danger p-4">${err.message}</div>`;
        }
    }

    document.addEventListener('DOMContentLoaded', loadLaporanPribadi);
</script>