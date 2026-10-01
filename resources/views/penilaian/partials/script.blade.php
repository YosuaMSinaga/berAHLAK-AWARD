<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ---------------- FORM ---------------- */
    const form = document.getElementById('penilaian-form');

    if (!form) {
        return;
    }

    /* ---------------- POPUP (CSS biasa, dipindah ke body agar mengambang) ---------------- */
    const modalElement = document.getElementById('konfirmasiPenilaianModal');

    if (modalElement && modalElement.parentElement !== document.body) {
        document.body.appendChild(modalElement);
    }

    function openPopup() {
        if (!modalElement) {
            return;
        }

        modalElement.classList.add('show');
        modalElement.setAttribute('aria-hidden', 'false');
        document.body.classList.add('kp-open');
    }

    function closePopup() {
        if (!modalElement) {
            return;
        }

        modalElement.classList.remove('show');
        modalElement.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('kp-open');

        // Kembalikan tombol simpan ke kondisi awal
        if (btnKonfirmasi) {
            btnKonfirmasi.disabled = false;
            btnKonfirmasi.innerHTML =
                '<i class="bi bi-check-lg"></i> Ya, Simpan Penilaian';
        }
    }

    // Tombol Batal dan X
    if (modalElement) {
        modalElement.querySelectorAll('[data-kp-close]').forEach(function (btn) {
            btn.addEventListener('click', closePopup);
        });
    }

    // Tekan ESC untuk menutup
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalElement && modalElement.classList.contains('show')) {
            closePopup();
        }
    });

    /* ---------------- ELEMENT ---------------- */
    const implementationCheckboxes = document.querySelectorAll('.implementation-checkbox');
    const pegawaiCheckboxes        = document.querySelectorAll('.pegawai-checkbox');

    const implementationCounter = document.getElementById('implementation-counter');
    const pegawaiCounter        = document.getElementById('pegawai-counter');

    const btnKonfirmasi = document.getElementById('btn-konfirmasi-penilaian');

    /* ---------------- BATAS PILIHAN ---------------- */
    // Bagian 1 = jum_pilihan | Bagian 2 = max_pilihan
    const jumPilihan = Number(@json($settingAktif->jum_pilihan ?? 1));
    const maxPilihan = Number(@json($settingAktif->max_pilihan ?? 1));

    /* ---------------- HELPER ---------------- */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text ?? '';
        return div.innerHTML;
    }

    function updateImplementationCounter() {
        const selected = document.querySelectorAll('.implementation-checkbox:checked').length;

        if (implementationCounter) {
            implementationCounter.textContent = selected + ' / ' + jumPilihan;
        }
    }

    function updatePegawaiCounter() {
        const selected = document.querySelectorAll('.pegawai-checkbox:checked').length;

        if (pegawaiCounter) {
            pegawaiCounter.textContent = selected + ' / ' + maxPilihan;
        }
    }

    function updateCardStyle(checkbox) {
        const card = checkbox.closest('.choice-card');

        if (!card) {
            return;
        }

        card.classList.toggle('selected', checkbox.checked);
    }

    /* ---------------- CHECKBOX IMPLEMENTASI ---------------- */
    implementationCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const selected = document.querySelectorAll('.implementation-checkbox:checked').length;

            if (selected > jumPilihan) {
                this.checked = false;
                alert('Maksimal ' + jumPilihan + ' poin implementasi yang dapat dipilih.');
                return;
            }

            updateCardStyle(this);
            updateImplementationCounter();
        });
    });

    /* ---------------- CHECKBOX PEGAWAI ---------------- */
    pegawaiCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const selected = document.querySelectorAll('.pegawai-checkbox:checked').length;

            if (selected > maxPilihan) {
                this.checked = false;
                alert('Maksimal ' + maxPilihan + ' pegawai yang dapat dipilih.');
                return;
            }

            updateCardStyle(this);
            updatePegawaiCounter();
        });
    });

    /* ---------------- SUBMIT FORM -> TAMPILKAN POPUP ---------------- */
    form.addEventListener('submit', function (event) {

        // Tahan submit asli, popup konfirmasi dulu
        event.preventDefault();

        const selectedImplementasi = document.querySelectorAll('.implementation-checkbox:checked');
        const selectedPegawai      = document.querySelectorAll('.pegawai-checkbox:checked');

        /* ----- VALIDASI ----- */
        if (selectedImplementasi.length === 0) {
            alert('Silakan pilih minimal 1 implementasi nilai.');
            return;
        }

        if (selectedImplementasi.length > jumPilihan) {
            alert('Maksimal ' + jumPilihan + ' implementasi yang dapat dipilih.');
            return;
        }

        if (selectedPegawai.length === 0) {
            alert('Silakan pilih minimal 1 pegawai.');
            return;
        }

        if (selectedPegawai.length > maxPilihan) {
            alert('Maksimal ' + maxPilihan + ' pegawai yang dapat dipilih.');
            return;
        }

        /* ----- ISI POPUP ----- */
        const popupPeriode      = document.getElementById('popup-periode');
        const popupValue        = document.getElementById('popup-value');
        const popupImplementasi = document.getElementById('popup-implementasi');
        const popupPegawai      = document.getElementById('popup-pegawai');

        if (popupPeriode) {
            popupPeriode.textContent = @json($settingAktif->periode ?? '-');
        }

        if (popupValue) {
            popupValue.textContent = @json($settingAktif->value ?? '-');
        }

        if (popupImplementasi) {
            let html = '<ul>';

            selectedImplementasi.forEach(function (checkbox) {
                html += '<li>' + escapeHtml(checkbox.value) + '</li>';
            });

            html += '</ul>';

            popupImplementasi.innerHTML = html;
        }

        if (popupPegawai) {
            let html = '<div>';

            selectedPegawai.forEach(function (checkbox) {
                const name    = checkbox.dataset.name || checkbox.value;
                const nip     = checkbox.dataset.nip || '';
                const jabatan = checkbox.dataset.jabatan || '';

                html += '<div class="kp-pegawai">';
                html += '<div class="kp-pegawai-name">' + escapeHtml(name) + '</div>';

                if (nip || jabatan) {
                    html += '<div class="kp-pegawai-info">';

                    if (nip) {
                        html += 'NIP: ' + escapeHtml(nip);
                    }

                    if (nip && jabatan) {
                        html += ' &nbsp;|&nbsp; ';
                    }

                    if (jabatan) {
                        html += escapeHtml(jabatan);
                    }

                    html += '</div>';
                }

                html += '</div>';
            });

            html += '</div>';

            popupPegawai.innerHTML = html;
        }

        /* ----- TAMPILKAN MODAL ----- */
        openPopup();
    });

    /* ---------------- TOMBOL "YA, SIMPAN PENILAIAN" ---------------- */
    if (btnKonfirmasi) {
        btnKonfirmasi.addEventListener('click', function () {
            btnKonfirmasi.disabled = true;
            btnKonfirmasi.innerHTML =
                'Menyimpan...';

            // Submit asli (tidak memicu event 'submit' lagi)
            form.submit();
        });
    }

    /* ---------------- INISIALISASI ---------------- */
    updateImplementationCounter();
    updatePegawaiCounter();

    document
        .querySelectorAll('.implementation-checkbox:checked, .pegawai-checkbox:checked')
        .forEach(function (checkbox) {
            updateCardStyle(checkbox);
        });

});
</script>