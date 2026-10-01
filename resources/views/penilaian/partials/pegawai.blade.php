<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">

<div class="pegawai-section-clean">

    <div class="sec-header-clean">
        <div>
            <h5 class="sec-title-clean">
                Bagian 2: Pilih Pegawai
            </h5>
            <p class="sec-description-clean">
                Pilih pegawai yang dinilai sesuai dengan ketentuan yang berlaku.
            </p>
        </div>

        <div class="sec-counter-wrapper">
            <span class="sec-counter-label">Pilihan</span>
            <span class="sec-counter-badge" id="pegawai-counter">
                0 / {{ $settingAktif->max_pilihan ?? 1 }}
            </span>
        </div>
    </div>

    <div class="sec-body-clean">

        @if(!empty($pegawai) && count($pegawai) > 0)

            <div class="row g-3">
                @foreach($pegawai as $item)

                    @php
                        if (is_array($item)) {
                            $nama = $item['nama'] ?? $item['name'] ?? '-';
                            $nip = $item['nip'] ?? $item['NIP'] ?? '';
                            $jabatan = $item['jabatan'] ?? $item['position'] ?? '';
                        } elseif (is_object($item)) {
                            $nama = $item->nama ?? $item->name ?? '-';
                            $nip = $item->nip ?? $item->NIP ?? '';
                            $jabatan = $item->jabatan ?? $item->position ?? '';
                        } else {
                            $nama = $item;
                            $nip = '';
                            $jabatan = '';
                        }
                    @endphp

                    <div class="col-md-6">
                        <div class="modern-choice-card pegawai-card h-100">
                            <div class="form-check custom-checkbox-box">
                                <input 
                                    class="form-check-input pegawai-checkbox" 
                                    type="checkbox" 
                                    name="pilihan_pegawai[]" 
                                    value="{{ $nip ?: $nama }}" 
                                    data-name="{{ $nama }}"
                                    data-nip="{{ $nip }}"
                                    data-jabatan="{{ $jabatan }}"
                                    id="pegawai-{{ $loop->index }}"
                                >

                                <label class="form-check-label w-100" for="pegawai-{{ $loop->index }}">
                                    <div class="choice-content">
                                        <div class="choice-indicator">
                                            <i class="bi bi-check"></i>
                                        </div>
                                        <div class="pegawai-details">
                                            <div class="pegawai-name">
                                                {{ $nama }}
                                            </div>

                                            @if($nip || $jabatan)
                                                <div class="pegawai-info">
                                                    @if($nip)
                                                        <span>NIP: {{ $nip }}</span>
                                                    @endif
                                                    @if($nip && $jabatan)
                                                        <span class="bullet-separator">•</span>
                                                    @endif
                                                    @if($jabatan)
                                                        <span>{{ $jabatan }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        @else

            <div class="empty-state-modern">
                <div class="empty-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Data pegawai belum tersedia</h6>
                <p class="text-muted mb-0 font-sm">
                    Belum ada data pegawai yang dapat dinilai saat ini.
                </p>
            </div>

        @endif

    </div>
</div>

<style>
    /* Menerapkan font Lato dan box-sizing pada seluruh komponen */
    .pegawai-section-clean, 
    .pegawai-section-clean * {
        font-family: 'Lato', sans-serif !important;
        box-sizing: border-box;
    }

    /* Container Utama Tanpa Pembungkus Card (Clean Layout) */
    .pegawai-section-clean {
        background: transparent;
        border: none;
        box-shadow: none;
        margin-bottom: 28px;
    }

    /* Header Bagian */
    .sec-header-clean {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .sec-title-clean {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px 0;
        letter-spacing: -0.01em;
    }

    .sec-description-clean {
        font-size: 13.5px;
        color: #64748b;
        margin: 0;
    }

    /* Counter Badge di Header */
    .sec-counter-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 6px 12px;
        border-radius: 10px;
    }

    .sec-counter-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .sec-counter-badge {
        font-size: 14px;
        font-weight: 700;
        color: #059669;
        background: #ecfdf5;
        padding: 2px 8px;
        border-radius: 6px;
    }

    /* Body Bagian */
    .sec-body-clean {
        padding: 0;
    }

    /* Kartu Pilihan Pegawai Modern */
    .modern-choice-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.2s ease;
        position: relative;
    }

    .modern-choice-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    /* Styling saat card aktif/dipilih */
    .modern-choice-card.selected {
        background: #f0fdf4;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.06);
    }

    .custom-checkbox-box {
        padding: 16px !important;
        margin: 0 !important;
    }

    /* Sembunyikan checkbox bawaan standar */
    .custom-checkbox-box .form-check-input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
        padding-left: 0 !important;
    }

    /* Layout Konten & Indikator Ceklis */
    .choice-content {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .choice-indicator {
        width: 22px;
        height: 22px;
        border: 2px solid #cbd5e1;
        border-radius: 6px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: transparent;
        flex-shrink: 0;
        margin-top: 1px;
        transition: all 0.2s ease;
    }

    .modern-choice-card.selected .choice-indicator {
        background: #059669;
        border-color: #059669;
        color: #ffffff;
    }

    /* Teks Pegawai */
    .pegawai-name {
        font-size: 14.5px;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .modern-choice-card.selected .pegawai-name {
        color: #064e3b;
    }

    .pegawai-info {
        font-size: 12.5px;
        color: #64748b;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 4px;
    }

    .bullet-separator {
        color: #cbd5e1;
        font-size: 10px;
    }

    /* Disabled State */
    .form-check-input:disabled ~ .form-check-label {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .form-check-input:disabled ~ .form-check-label .modern-choice-card {
        cursor: not-allowed;
    }

    /* Empty State Modern */
    .empty-state-modern {
        text-align: center;
        padding: 36px 20px;
        background: #ffffff;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
    }

    .empty-icon {
        width: 52px;
        height: 52px;
        background: #f1f5f9;
        color: #64748b;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin: 0 auto 12px auto;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkboxes = document.querySelectorAll(
        '.pegawai-checkbox'
    );

    const counter = document.getElementById(
        'pegawai-counter'
    );

    const maxPilihan = {{ (int) ($settingAktif->max_pilihan ?? 1) }};

    function updatePegawaiSelection() {

        const checked = document.querySelectorAll(
            '.pegawai-checkbox:checked'
        );

        const jumlahDipilih = checked.length;

        if (counter) {
            counter.textContent =
                jumlahDipilih + ' / ' + maxPilihan;
        }

        checkboxes.forEach(function (checkbox) {

            // Nonaktifkan checkbox lain jika sudah mencapai batas maksimum
            if (!checkbox.checked) {
                checkbox.disabled =
                    jumlahDipilih >= maxPilihan;
            } else {
                checkbox.disabled = false;
            }

            // Tambahkan/hapus class 'selected' pada kartu pembungkusnya
            const card = checkbox.closest('.pegawai-card');

            if (card) {
                card.classList.toggle(
                    'selected',
                    checkbox.checked
                );
            }

        });
    }

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updatePegawaiSelection();
        });
    });

    // Jalankan saat pertama kali halaman dimuat
    updatePegawaiSelection();

});
</script>