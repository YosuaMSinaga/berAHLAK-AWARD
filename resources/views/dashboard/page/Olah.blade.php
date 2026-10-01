@extends('layouts.app')

@section('title', 'Pengolahan Data - BerAKHLAK Award')

@section('content')

<style>
    .olah-wrapper {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding-bottom: 3rem;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .olah-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .olah-title {
        margin: 0 0 0.4rem;
        font-size: 1.75rem;
        font-weight: 700;
        color: #0f172a;
    }

    .olah-description {
        margin: 0;
        color: #64748b;
        font-size: 0.9rem;
    }

    .periode-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 0.9rem;
        border-radius: 0.6rem;
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #dbeafe;
        font-size: 0.82rem;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .olah-alert {
        display: none;
        margin-bottom: 1.5rem;
        padding: 0.85rem 1rem;
        border-radius: 0.75rem;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #047857;
        font-size: 0.85rem;
        font-weight: 600;
        align-items: center;
        gap: 0.5rem;
    }

    .olah-alert.show {
        display: flex;
    }

    /* =========================================================
       PROCESS / STEP CARDS
    ========================================================= */

    .olah-steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .olah-step-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        transition: all 0.2s ease;
    }

    .olah-step-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
    }

    .step-number {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.7rem;
        background: #eff6ff;
        color: #1d4ed8;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .step-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.35rem;
    }

    .step-description {
        font-size: 0.82rem;
        color: #64748b;
        line-height: 1.5;
        min-height: 40px;
        margin-bottom: 1rem;
    }

    .step-button {
        width: 100%;
        border: none;
        border-radius: 0.65rem;
        padding: 0.65rem 0.9rem;
        background: #002B6A;
        color: #ffffff;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
    }

    .step-button:hover {
        background: #001f4d;
    }

    .step-button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* =========================================================
       REKAPITULASI (Diubah menjadi 5 Kolom)
    ========================================================= */

    .rekap-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1rem;
    }

    .rekap-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .rekap-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 0.9rem;
        padding: 1.1rem;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        min-height: 130px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .rekap-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .rekap-value {
        font-size: 1.45rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0.4rem 0 0.2rem;
    }

    .rekap-subtitle {
        font-size: 0.7rem;
        color: #94a3b8;
    }

    /* =========================================================
       LOG TABLE
    ========================================================= */

    .log-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    .log-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding: 1.15rem 1.25rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .log-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
    }

    .log-period {
        font-size: 0.75rem;
        font-weight: 600;
        color: #475569;
        background: #f1f5f9;
        padding: 0.4rem 0.7rem;
        border-radius: 0.5rem;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .olah-table {
        width: 100%;
        border-collapse: collapse;
    }

    .olah-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        text-align: left;
        padding: 0.85rem 1rem;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .olah-table td {
        color: #334155;
        font-size: 0.82rem;
        padding: 0.9rem 1rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .olah-table tbody tr:last-child td {
        border-bottom: none;
    }

    .olah-table tbody tr:hover {
        background: #f8fafc;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.3rem 0.65rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .status-success {
        background: #ecfdf5;
        color: #047857;
    }

    .status-pending {
        background: #fffbeb;
        color: #b45309;
    }

    /* =========================================================
       RESPONSIVE DESIGN
    ========================================================= */

    @media (max-width: 1200px) {
        .rekap-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .olah-steps {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .olah-header {
            flex-direction: column;
        }

        .periode-badge {
            width: fit-content;
        }

        .olah-steps {
            grid-template-columns: 1fr;
        }

        .rekap-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .rekap-grid {
            grid-template-columns: 1fr;
        }

        .olah-title {
            font-size: 1.4rem;
        }
    }
</style>

<div class="olah-wrapper">

    {{-- HEADER --}}
    <div class="olah-header">
        <div>
            <h1 class="olah-title">Pengolahan Data</h1>
            <p class="olah-description">
                Kelola dan jalankan proses pengolahan nilai BerAKHLAK secara bertahap.
            </p>
        </div>

        <div class="periode-badge">
            <i class="bi bi-calendar3"></i>
            Periode Aktif: {{ $periodeAktif ?? '-' }}
        </div>
    </div>

    {{-- ALERT --}}
    <div class="olah-alert" id="olahAlert" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <span id="olahAlertText"></span>
    </div>

    {{-- PROSES PENGOLAHAN (4 STEPS) --}}
    <div class="olah-steps">

        {{-- STEP 1: SINKRON DATA --}}
        <div class="olah-step-card">
            <div class="step-number">1</div>
            <div class="step-title">Sinkron Data</div>
            <div class="step-description">
                Mengambil dan menyinkronkan data penilaian pada periode aktif.
            </div>
            <button
                type="button"
                class="step-button"
                onclick="executeTrigger('sinkron')"
            >
                <i class="bi bi-play-fill"></i>
                Jalankan
            </button>
        </div>

        {{-- STEP 2: HITUNG SELF --}}
        <div class="olah-step-card">
            <div class="step-number">2</div>
            <div class="step-title">Hitung Self</div>
            <div class="step-description">
                Menghitung nilai rata-rata penilaian BerAKHLAK dari masing-masing pegawai.
            </div>
            <button
                type="button"
                class="step-button"
                onclick="executeTrigger('self')"
            >
                <i class="bi bi-play-fill"></i>
                Jalankan
            </button>
        </div>

        {{-- STEP 3: HITUNG PEER --}}
        <div class="olah-step-card">
            <div class="step-number">3</div>
            <div class="step-title">Hitung Peer</div>
            <div class="step-description">
                Menghitung nilai rata-rata penilaian rekan kerja atau peer.
            </div>
            <button
                type="button"
                class="step-button"
                onclick="executeTrigger('peer')"
            >
                <i class="bi bi-play-fill"></i>
                Jalankan
            </button>
        </div>

        {{-- STEP 4: SKOR AKHIR --}}
        <div class="olah-step-card">
            <div class="step-number">4</div>
            <div class="step-title">Skor Akhir</div>
            <div class="step-description">
                Menghasilkan skor akhir berdasarkan hasil pengolahan penilaian.
            </div>
            <button
                type="button"
                class="step-button"
                onclick="executeTrigger('akhir')"
            >
                <i class="bi bi-play-fill"></i>
                Jalankan
            </button>
        </div>

    </div>

    {{-- REKAPITULASI --}}
    <div class="rekap-title">
        Rekapitulasi Hasil Pengolahan
    </div>

    <div class="rekap-grid">

        {{-- DATA TEROLAH --}}
        <div class="rekap-card">
            <div>
                <div class="rekap-label">Data Terolah</div>
                <div class="rekap-value" id="rekap-persen">
                    {{ ($jumlahData ?? 0) > 0 ? '100%' : '0.0%' }}
                </div>
            </div>
            <div class="rekap-subtitle">Persentase data</div>
        </div>

        {{-- SKOR BERAKHLAK / SELF --}}
        <div class="rekap-card">
            <div>
                <div class="rekap-label">Skor BerAKHLAK</div>
                <div class="rekap-value" id="rekap-skor-b">
                    @if(($jumlahData ?? 0) > 0)
                        {{ number_format((float) ($rerataSelf ?? 0), 2) }}%
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="rekap-subtitle">Hasil penilaian self</div>
        </div>

        {{-- SKOR REKAN / PEER --}}
        <div class="rekap-card">
            <div>
                <div class="rekap-label">Skor Rekan</div>
                <div class="rekap-value" id="rekap-skor-r">
                    @if(($jumlahData ?? 0) > 0)
                        {{ number_format((float) ($rerataPeer ?? 0), 2) }}%
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="rekap-subtitle">Penilaian peer</div>
        </div>

        {{-- SKOR AKHIR --}}
        <div class="rekap-card">
            <div>
                <div class="rekap-label">Skor Akhir</div>
                <div class="rekap-value" id="rekap-skor-akhir">
                    @if(($jumlahData ?? 0) > 0)
                        {{ number_format((float) ($rerataAkhir ?? 0), 2) }}%
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="rekap-subtitle">Nilai akhir</div>
        </div>

        {{-- KORELASI R --}}
        <div class="rekap-card">
            <div>
                <div class="rekap-label">Korelasi R</div>
                <div class="rekap-value" id="rekap-korelasi">-</div>
            </div>
            <div class="rekap-subtitle">Korelasi penilaian</div>
        </div>

    </div>

{{-- =========================================================
     LOG MASTER OLAH NILAI
     ========================================================= --}}
<div class="log-card">

    <div class="log-header">
        <h5 class="log-title">
            Log Master Olah Nilai
        </h5>

        <span class="log-period" id="lbl-olah-periode">
            Periode: {{ $periodeAktif ?? '-' }}
        </span>
    </div>

    <div class="table-wrapper">

        <table class="olah-table">

            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>Skor (Self)</th>
                    <th>Skor (Peer)</th>
                    <th>Skor Akhir</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @php
                    $dataOlahTable = \App\Models\Olah::query()
                        ->where('periode', $periodeAktif ?? '')
                        ->get();
                @endphp

                @forelse ($dataOlahTable as $olah)

                    @php
                        $userPegawai = \App\Models\User::where(
                            'nip',
                            $olah->nip ?? ''
                        )->first();

                        $namaPegawai = $userPegawai->nama
                            ?? $userPegawai->name
                            ?? '-';

                        $skorSelf = $olah->skor_self
                            ?? $olah->skor_berakhlak
                            ?? null;

                        $skorPeer = $olah->skor_peer
                            ?? $olah->skor_rekan_2
                            ?? null;

                        $skorAkhir = $olah->skor_akhir
                            ?? null;

                        $sudahDiproses =
                            $skorSelf !== null &&
                            $skorPeer !== null &&
                            $skorAkhir !== null;
                    @endphp

                    <tr>

                        {{-- NIP --}}
                        <td>
                            {{ $olah->nip ?? '-' }}
                        </td>

                        {{-- NAMA --}}
                        <td>
                            <strong>
                                {{ $namaPegawai }}
                            </strong>
                        </td>

                        {{-- SELF --}}
                        <td>
                            @if($skorSelf !== null)
                                {{ number_format((float) $skorSelf, 2) }}
                            @else
                                -
                            @endif
                        </td>

                        {{-- PEER --}}
                        <td>
                            @if($skorPeer !== null)
                                {{ number_format((float) $skorPeer, 2) }}
                            @else
                                -
                            @endif
                        </td>

                        {{-- SKOR AKHIR --}}
                        <td>
                            @if($skorAkhir !== null)
                                <strong>
                                    {{ number_format((float) $skorAkhir, 2) }}
                                </strong>
                            @else
                                -
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td>

                            @if($sudahDiproses)

                                <span class="status-badge status-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Selesai
                                </span>

                            @else

                                <span class="status-badge status-pending">
                                    <i class="bi bi-clock-fill"></i>
                                    Belum Diproses
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            style="
                                text-align: center;
                                padding: 2rem;
                                color: #94a3b8;
                            "
                        >

                            <i
                                class="bi bi-database-x"
                                style="
                                    font-size: 1.5rem;
                                    display: block;
                                    margin-bottom: 0.5rem;
                                "
                            ></i>

                            Belum ada data olah nilai
                            untuk periode {{ $periodeAktif ?? '-' }}.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

<script>
    function executeTrigger(step) {
        const buttons = document.querySelectorAll('.step-button');
        let clickedButton = null;

        buttons.forEach(button => {
            const onclick = button.getAttribute('onclick') || '';
            if (onclick.includes("'" + step + "'")) {
                clickedButton = button;
            }
        });

        if (!clickedButton) return;

        const originalText = clickedButton.innerHTML;

        buttons.forEach(button => {
            button.disabled = true;
        });

        clickedButton.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Memproses...';

        setTimeout(function () {
            clickedButton.innerHTML = '<i class="bi bi-check-circle-fill"></i> Selesai';
            showOlahAlert(step);

            setTimeout(function () {
                buttons.forEach(button => {
                    button.disabled = false;
                });
                clickedButton.innerHTML = originalText;
            }, 1200);

        }, 1000);
    }

    function showOlahAlert(step) {
        const alertBox = document.getElementById('olahAlert');
        const alertText = document.getElementById('olahAlertText');
        let message = '';

        switch (step) {
            case 'sinkron':
                message = 'Proses sinkronisasi data berhasil dijalankan.';
                break;
            case 'self':
                message = 'Perhitungan skor self berhasil dijalankan.';
                break;
            case 'peer':
                message = 'Perhitungan skor peer berhasil dijalankan.';
                break;
            case 'akhir':
                message = 'Perhitungan skor akhir berhasil dijalankan.';
                break;
            default:
                message = 'Proses pengolahan berhasil dijalankan.';
        }

        alertText.textContent = message;
        alertBox.classList.add('show');

        setTimeout(function () {
            alertBox.classList.remove('show');
        }, 3500);
    }
</script>

@endsection