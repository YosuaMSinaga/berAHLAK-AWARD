<div class="sec-card">

    <div class="sec-header">
        <div>
            <h5 class="sec-title">
                Bagian 1: Pilih Implementasi Nilai
            </h5>
            <p class="sec-description">
                Pilih maksimal 
                <span class="fw-bold text-success">
                    {{ $settingAktif->jum_pilihan ?? 1 }}
                </span> 
                poin implementasi yang sesuai di bawah ini.
            </p>
        </div>

        <div class="sec-counter-wrapper">
            <span class="sec-counter-label">Pilihan</span>
            <span class="sec-counter-badge" id="implementation-counter">
                0 / {{ $settingAktif->jum_pilihan ?? 1 }}
            </span>
        </div>
    </div>

    <div class="sec-body">

        @if(!empty($implementasi) && count($implementasi) > 0)

            <div class="row g-3">
                @foreach($implementasi as $item)

                    @php
                        if (is_array($item)) {
                            $text = $item['implementasi'] 
                                ?? $item['text'] 
                                ?? $item['value'] 
                                ?? $item['nama'] 
                                ?? '';
                        } elseif (is_object($item)) {
                            $text = $item->implementasi 
                                ?? $item->text 
                                ?? $item->value 
                                ?? $item->nama 
                                ?? '';
                        } else {
                            $text = $item;
                        }
                    @endphp

                    @if($text)
                        <div class="col-md-6">
                            <div class="modern-choice-card implementation-card h-100">
                                <div class="form-check custom-checkbox-box">
                                    <input 
                                        class="form-check-input implementation-checkbox" 
                                        type="checkbox" 
                                        name="pilihan_berakhlak[]" 
                                        value="{{ $text }}" 
                                        id="implementasi-{{ $loop->index }}"
                                    >

                                    <label class="form-check-label w-100" for="implementasi-{{ $loop->index }}">
                                        <div class="choice-content">
                                            <div class="choice-indicator">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <div class="choice-text">
                                                {{ $text }}
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>

        @else

            <div class="empty-state-modern">
                <div class="empty-icon">
                    <i class="bi bi-inbox"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Data implementasi belum tersedia</h6>
                <p class="text-muted mb-0 font-sm">
                    Belum ada implementasi nilai untuk <strong>{{ $settingAktif->value ?? 'Core Value ini' }}</strong>.
                </p>
            </div>

        @endif

    </div>
</div>

<style>
    /* Menerapkan font Lato dan box-sizing pada seluruh elemen Bagian 1 */
    .sec-card, 
    .sec-card * {
        font-family: 'Lato', sans-serif !important;
        box-sizing: border-box;
    }

    /* Container Utama */
    .sec-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -2px rgba(0, 0, 0, 0.02);
        margin-bottom: 24px;
        overflow: hidden;
    }

    /* Header Bagian */
    .sec-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        flex-wrap: wrap;
        padding: 22px 24px;
        background: #fafafa;
        border-bottom: 1px solid #f1f5f9;
    }

    .sec-title {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px 0;
        letter-spacing: -0.01em;
    }

    .sec-description {
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
    .sec-body {
        padding: 24px;
    }

    /* Kartu Pilihan (Modern Checkbox Card) */
    .modern-choice-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.2s ease;
        position: relative;
    }

    .modern-choice-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }

    /* Styling saat card aktif/dipilih via JS */
    .modern-choice-card.selected {
        background: #f0fdf4;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.08);
    }

    .custom-checkbox-box {
        padding: 16px !important;
        margin: 0 !important;
    }

    /* Sembunyikan checkbox bawaan standar agar diganti tampilan custom card */
    .custom-checkbox-box .form-check-input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
        padding-left: 0 !important;
    }

    /* Layout Isi Teks dan Indikator Ceklis */
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

    .choice-text {
        font-size: 14px;
        color: #334155;
        line-height: 1.5;
        font-weight: 500;
    }

    .modern-choice-card.selected .choice-text {
        color: #064e3b;
        font-weight: 600;
    }

    /* Disabled State (Jika kuota pilihan habis) */
    .form-check-input:disabled ~ .form-check-label {
        opacity: 0.55;
        cursor: not-allowed;
    }

    .form-check-input:disabled ~ .form-check-label .modern-choice-card {
        cursor: not-allowed;
    }

    /* Empty State Modern */
    .empty-state-modern {
        text-align: center;
        padding: 36px 20px;
    }

    .empty-icon {
        width: 56px;
        height: 56px;
        background: #f1f5f9;
        color: #64748b;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin: 0 auto 14px auto;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkboxes = document.querySelectorAll(
        '.implementation-checkbox'
    );

    const counter = document.getElementById(
        'implementation-counter'
    );

    const maxPilihan = {{ (int) ($settingAktif->jum_pilihan ?? 1) }};

    function updateImplementationSelection() {

        const checked = document.querySelectorAll(
            '.implementation-checkbox:checked'
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
            const card = checkbox.closest('.implementation-card');

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
            updateImplementationSelection();
        });
    });

    // Jalankan saat pertama kali halaman dimuat
    updateImplementationSelection();

});
</script>