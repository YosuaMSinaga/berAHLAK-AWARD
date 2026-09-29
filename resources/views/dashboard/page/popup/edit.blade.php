{{-- Modal Edit Nomor Sertifikat --}}
<div class="modal fade"
     id="modalEditNoSertifikat"
     tabindex="-1"
     aria-labelledby="modalEditNoSertifikatLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            {{-- Header --}}
            <div class="modal-header bg-primary text-white py-2">

                <h6 class="modal-title fw-bold"
                    id="modalEditNoSertifikatLabel">

                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Nomor Sertifikat

                </h6>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>

            {{-- Body --}}
            <div class="modal-body p-3">

                <input type="hidden"
                       id="edit-cert-periode">

                <input type="hidden"
                       id="edit-cert-nip">

                {{-- Nama --}}
                <div class="mb-3">

                    <label class="form-label small fw-semibold text-muted">
                        Nama Pemenang
                    </label>

                    <input type="text"
                           id="edit-cert-nama"
                           class="form-control bg-light"
                           readonly>

                </div>

                {{-- Nomor Sertifikat --}}
                <div class="mb-3">

                    <label class="form-label small fw-semibold text-dark">
                        Nomor Sertifikat
                    </label>

                    <input type="text"
                           id="edit-cert-nosert"
                           class="form-control"
                           placeholder="Contoh: 001/BA-BPS/DAIRI/2026">

                    <small class="text-muted"
                           style="font-size: 0.75rem;">

                        Kosongkan jika ingin menggunakan
                        nomor generasi otomatis bawaan sistem.

                    </small>

                </div>

            </div>

            {{-- Footer --}}
            <div class="modal-footer py-2">

                <button type="button"
                        class="btn btn-secondary btn-sm fw-bold"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <button type="button"
                        id="btn-save-nosert"
                        class="btn btn-primary btn-sm fw-bold"
                        onclick="handleSaveNoSertifikat()">

                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Nomor

                </button>

            </div>

        </div>

    </div>

</div>