{{-- Modal Draft / Preview Sertifikat --}}
<div class="modal fade"
     id="modalSertifikat"
     tabindex="-1"
     aria-labelledby="modalSertifikatLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            {{-- Header Modal --}}
            <div class="modal-header bg-dark text-white py-2">

                <h6 class="modal-title fw-bold"
                    id="modalSertifikatLabel">

                    <i class="bi bi-file-earmark-pdf-fill text-warning me-2"></i>
                    Draft Sertifikat Penghargaan

                </h6>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            {{-- Body --}}
            <div class="modal-body bg-secondary bg-opacity-10 p-3 text-center overflow-auto"
                 style="max-height: 80vh;">

                {{-- =====================================================
                     SERTIFIKAT
                ====================================================== --}}

                <article id="cert-print-area"
                         class="certificate mx-auto">

                    {{-- Frame --}}
                    <div class="frame-outer"
                         aria-hidden="true">
                    </div>

                    <div class="frame-middle"
                         aria-hidden="true">
                    </div>

                    <div class="frame-inner"
                         aria-hidden="true">
                    </div>


                    {{-- Corner Technology --}}
                    <div class="corner-tech corner-tl"
                         aria-hidden="true">

                        <span></span>

                    </div>

                    <div class="corner-tech corner-tr"
                         aria-hidden="true">

                        <span></span>

                    </div>

                    <div class="corner-tech corner-br"
                         aria-hidden="true">

                        <span></span>

                    </div>

                    <div class="corner-tech corner-bl"
                         aria-hidden="true">

                        <span></span>

                    </div>


                    {{-- Circuit kiri --}}
                    <div class="circuit circuit-left"
                         aria-hidden="true">

                        <span class="circuit-line one"></span>
                        <span class="circuit-line two"></span>
                        <span class="circuit-line three"></span>

                    </div>


                    {{-- Circuit kanan --}}
                    <div class="circuit circuit-right"
                         aria-hidden="true">

                        <span class="circuit-line one"></span>
                        <span class="circuit-line two"></span>
                        <span class="circuit-line three"></span>

                    </div>


                    {{-- Watermark --}}
                    <div class="orbit-watermark"
                         aria-hidden="true">

                        <span class="orbit-core"></span>

                    </div>


                    {{-- =================================================
                         CONTENT SERTIFIKAT
                    ================================================== --}}

                    <div class="certificate-content">


                        {{-- Header Logo --}}
                        <header class="identity-row">

                            {{-- Logo BPS --}}
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


                            {{-- Logo BerAKHLAK --}}
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


                        {{-- Divider --}}
                        <div class="header-divider"
                             aria-hidden="true">
                        </div>


                        {{-- Award Pill --}}
                        <div class="award-pill">

                            BERAKHLAK AWARD

                        </div>


                        {{-- =================================================
                             TITLE
                        ================================================== --}}

                        <section class="title-block">

                            <h2 class="certificate-title">
                                SERTIFIKAT
                            </h2>

                            <h3 class="certificate-subtitle">
                                PENGHARGAAN
                            </h3>

                            <p id="certificate-number"
                               class="certificate-number">

                                NO. -

                            </p>

                            <div class="title-ornament"
                                 aria-hidden="true">

                                <span></span>

                            </div>

                        </section>


                        {{-- =================================================
                             RECIPIENT
                        ================================================== --}}

                        <section class="recipient-block">

                            <p class="recipient-prefix">
                                diberikan kepada:
                            </p>

                            <p id="cert-nama"
                               class="recipient-name">

                                -

                            </p>

                            <p id="cert-nip"
                               class="recipient-nip">

                                NIP. -

                            </p>

                        </section>


                        {{-- =================================================
                             NARRATIVE
                        ================================================== --}}

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


                        {{-- =================================================
                             SIGNATURE
                        ================================================== --}}

                        <section class="signature-block">

                            <p id="cert-place"
                               class="signature-place">

                                Sidikalang, {{ date('d F Y') }}

                            </p>

                            <p id="cert-role-one"
                               class="signature-role">

                                Kepala Badan Pusat Statistik

                            </p>

                            <p id="cert-role-two"
                               class="signature-role">

                                Kabupaten Dairi

                            </p>

                            <div class="signature-space"
                                 aria-hidden="true">
                            </div>

                            <p id="cert-ttd-nama"
                               class="signature-name">

                                Joel Roy Perangin-Angin

                            </p>

                        </section>


                    </div>

                </article>

            </div>


            {{-- Footer --}}
            <div class="modal-footer bg-light py-2">

                <button type="button"
                        class="btn btn-secondary btn-sm fw-bold px-3"
                        data-bs-dismiss="modal">

                    Tutup

                </button>

                <button type="button"
                        class="btn btn-danger btn-sm fw-bold px-4"
                        onclick="printSertifikat()">

                    <i class="bi bi-printer-fill me-1"></i>

                    Cetak / Simpan PDF

                </button>

            </div>

        </div>

    </div>

</div>