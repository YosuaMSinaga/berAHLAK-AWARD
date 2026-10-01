{{-- =========================================================
     POPUP KONFIRMASI PENILAIAN
     resources/views/dashboard/page/popup/konfirmasi.blade.php
========================================================= --}}

<div
    class="modal fade"
    id="konfirmasiPenilaianModal"
    tabindex="-1"
    aria-labelledby="konfirmasiPenilaianModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">

        <div class="modal-content konfirmasi-modal">


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title"
                        id="konfirmasiPenilaianModalLabel"
                    >

                        <i class="bi bi-check-circle-fill"></i>

                        Konfirmasi Penilaian

                    </h5>


                    <div class="modal-subtitle">

                        Periksa kembali pilihan Anda
                        sebelum mengirim penilaian.

                    </div>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- =================================================
                 BODY
            ================================================== --}}

            <div class="modal-body">


                {{-- PERIODE --}}

                <div class="info-box">

                    <div class="info-item">

                        <div class="info-label">
                            PERIODE
                        </div>

                        <div
                            id="popup-periode"
                            class="info-value"
                        >
                            -
                        </div>

                    </div>


                    {{-- CORE VALUE --}}

                    <div class="info-item">

                        <div class="info-label">
                            CORE VALUE
                        </div>

                        <span
                            id="popup-value"
                            class="value-badge"
                        >
                            -
                        </span>

                    </div>

                </div>


                {{-- =================================================
                     IMPLEMENTASI
                ================================================== --}}

                <div class="popup-section">

                    <div class="popup-section-title">

                        <i class="bi bi-list-check"></i>

                        Implementasi yang Dipilih

                    </div>


                    <div class="popup-list-box">

                        <ol
                            id="popup-implementasi"
                            class="popup-list"
                        >
                        </ol>

                    </div>

                </div>


                {{-- =================================================
                     PEGAWAI
                ================================================== --}}

                <div class="popup-section">

                    <div class="popup-section-title">

                        <i class="bi bi-people-fill"></i>

                        Pegawai yang Dinilai

                    </div>


                    <div class="popup-list-box">

                        <ol
                            id="popup-pegawai"
                            class="popup-list"
                        >
                        </ol>

                    </div>

                </div>


                {{-- =================================================
                     PERINGATAN
                ================================================== --}}

                <div class="confirmation-warning">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    <span>

                        Pastikan seluruh pilihan sudah benar.
                        Setelah dikirim, penilaian akan
                        disimpan ke sistem.

                    </span>

                </div>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="modal-footer">


                <button
                    type="button"
                    class="btn btn-light btn-cancel"
                    data-bs-dismiss="modal"
                >

                    <i class="bi bi-arrow-left"></i>

                    Periksa Lagi

                </button>


                <button
                    type="button"
                    id="btn-konfirmasi-penilaian"
                    class="btn btn-success btn-confirm"
                >

                    <i class="bi bi-send-check-fill"></i>

                    Ya, Kirim Penilaian

                </button>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     CSS POPUP
========================================================= --}}

<style>

    #konfirmasiPenilaianModal .modal-dialog {
        max-width: 520px;
    }


    #konfirmasiPenilaianModal .konfirmasi-modal {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow:
            0 15px 40px rgba(0, 0, 0, 0.15);
    }


    /* HEADER */

    #konfirmasiPenilaianModal .modal-header {
        padding: 1.1rem 1.25rem;
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
    }


    #konfirmasiPenilaianModal .modal-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }


    #konfirmasiPenilaianModal .modal-title i {
        color: #198754;
        margin-right: 5px;
    }


    #konfirmasiPenilaianModal .modal-subtitle {
        margin-top: 3px;
        font-size: 0.78rem;
        color: #6b7280;
    }


    /* BODY */

    #konfirmasiPenilaianModal .modal-body {
        padding: 1.15rem 1.25rem;
        background: #ffffff;
    }


    /* INFO */

    #konfirmasiPenilaianModal .info-box {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }


    #konfirmasiPenilaianModal .info-item {
        padding: 0.75rem;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }


    #konfirmasiPenilaianModal .info-label {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #9ca3af;
        margin-bottom: 4px;
    }


    #konfirmasiPenilaianModal .info-value {
        font-size: 0.88rem;
        font-weight: 700;
        color: #1f2937;
    }


    #konfirmasiPenilaianModal .value-badge {
        display: inline-block;
        padding: 0.25rem 0.7rem;
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
        border-radius: 50px;
        color: #166534;
        font-size: 0.78rem;
        font-weight: 700;
    }


    /* SECTION */

    #konfirmasiPenilaianModal .popup-section {
        margin-top: 0.9rem;
    }


    #konfirmasiPenilaianModal .popup-section-title {
        font-size: 0.84rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 0.5rem;
    }


    #konfirmasiPenilaianModal .popup-section-title i {
        color: #198754;
        margin-right: 4px;
    }


    /* LIST */

    #konfirmasiPenilaianModal .popup-list-box {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.7rem 0.8rem;
        max-height: 150px;
        overflow-y: auto;
    }


    #konfirmasiPenilaianModal .popup-list {
        margin: 0;
        padding-left: 1.35rem;
        color: #374151;
        font-size: 0.8rem;
        line-height: 1.45;
    }


    #konfirmasiPenilaianModal .popup-list li {
        padding: 0.3rem 0;
    }


    #konfirmasiPenilaianModal .popup-list li:last-child {
        margin-bottom: 0;
    }


    #konfirmasiPenilaianModal .popup-list small {
        font-size: 0.7rem;
        margin-top: 2px;
    }


    /* WARNING */

    #konfirmasiPenilaianModal .confirmation-warning {

        display: flex;

        align-items: flex-start;

        gap: 0.55rem;

        margin-top: 1rem;

        padding: 0.7rem 0.8rem;

        background: #fffbeb;

        border: 1px solid #fde68a;

        border-radius: 8px;

        color: #92400e;

        font-size: 0.76rem;

        line-height: 1.4;

    }


    #konfirmasiPenilaianModal .confirmation-warning i {
        margin-top: 2px;
    }


    /* FOOTER */

    #konfirmasiPenilaianModal .modal-footer {

        padding: 0.85rem 1.25rem;

        background: #ffffff;

        border-top: 1px solid #e5e7eb;

        display: flex;

        justify-content: flex-end;

        gap: 0.5rem;

    }


    #konfirmasiPenilaianModal .btn {

        border-radius: 7px;

        font-size: 0.8rem;

        font-weight: 700;

        padding: 0.5rem 0.8rem;

    }


    #konfirmasiPenilaianModal .btn i {
        margin-right: 3px;
    }


    #konfirmasiPenilaianModal .btn-cancel {

        border: 1px solid #d1d5db;

        color: #374151;

        background: #ffffff;

    }


    #konfirmasiPenilaianModal .btn-confirm {

        background: #198754;

        border-color: #198754;

        color: #ffffff;

    }


    #konfirmasiPenilaianModal .btn-confirm:hover {

        background: #157347;

        border-color: #157347;

    }


    /* MOBILE */

    @media (max-width: 576px) {

        #konfirmasiPenilaianModal .modal-dialog {
            margin: 0.75rem;
        }


        #konfirmasiPenilaianModal .info-box {
            grid-template-columns: 1fr;
        }


        #konfirmasiPenilaianModal .modal-footer {

            flex-direction: column-reverse;

        }


        #konfirmasiPenilaianModal .modal-footer .btn {

            width: 100%;

        }

    }

</style>

