@extends('layouts.app')

@section('title', 'Pengaturan Periode Penilaian BerAKHLAK')

@section('content')

<style>
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --danger: #dc2626;
        --danger-hover: #b91c1c;
        --success: #16a34a;
        --success-bg: #dcfce7;
        --success-text: #166534;
        --secondary: #64748b;
        --secondary-bg: #f1f5f9;
        --border-color: #e2e8f0;
        --bg-main: #f8fafc;
        --card-bg: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --radius: 20px;
    }

    .custom-page-container {
        padding: 2rem 1rem;
        background-color: var(--bg-main);
        font-family: 'Lato', sans-serif;
        color: var(--text-main);
        min-height: 85vh;
    }

    .custom-wrapper {
        max-width: 1050px;
        margin: 0 auto;
    }

    /* Page Header */
    .custom-header {
        margin-bottom: 1.5rem;
    }
    .custom-header h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.25rem;
    }
    .custom-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin: 0;
    }

    /* Alerts */
    .custom-alert {
        padding: 1rem 1.25rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        border-left: 5px solid;
    }
    .custom-alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-color: #10b981;
    }
    .custom-alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border-color: #ef4444;
    }
    .custom-alert ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Cards */
    .custom-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        margin-bottom: 2rem;
        overflow: hidden;
    }
    .custom-card-header {
        background-color: #ffffff;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .custom-card-header h4, .custom-card-header h5 {
        margin: 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .custom-card-body {
        padding: 1.5rem;
    }

    /* Form Inputs */
    .custom-form-group {
        margin-bottom: 1.25rem;
    }
    .custom-label {
        display: block;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--secondary);
        margin-bottom: 0.5rem;
    }
    .custom-input, .custom-select {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background-color: #fff;
        color: var(--text-main);
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .custom-input:focus, .custom-select:focus {
        outline: none;
        border-color: var(--danger);
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }
    .custom-help-text {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 0.35rem;
    }

    .custom-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .custom-col {
        flex: 1;
        min-width: 250px;
    }

    /* Buttons */
    .custom-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 700;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.2s, transform 0.1s;
        width: 100%;
    }
    .custom-btn:active {
        transform: translateY(1px);
    }
    .custom-btn-danger {
        background-color: var(--danger);
        color: white;
    }
    .custom-btn-danger:hover {
        background-color: var(--danger-hover);
    }
    .custom-btn-primary {
        background-color: var(--primary);
        color: white;
        padding: 0.4rem 1rem;
        font-size: 0.85rem;
    }
    .custom-btn-primary:hover {
        background-color: var(--primary-hover);
    }

    /* Table Styles */
    .custom-table-responsive {
        width: 100%;
        overflow-x: auto;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.95rem;
    }
    .custom-table th {
        background-color: #1e293b;
        color: #ffffff;
        padding: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .custom-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
        vertical-align: middle;
    }
    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badges */
    .custom-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 50px;
        text-align: center;
    }
    .badge-success {
        background-color: var(--success-bg);
        color: var(--success-text);
    }
    .badge-secondary {
        background-color: var(--secondary-bg);
        color: var(--secondary);
    }
    .badge-light {
        background-color: #f1f5f9;
        color: #334155;
        border: 1px solid var(--border-color);
    }
    .text-center { text-align: center; }
</style>

<div class="custom-page-container">
  <div class="custom-wrapper">

    <!-- Header -->
    <div class="custom-header">
      <h2>Pengaturan Periode Penilaian</h2>
      <p>Kelola periode pengumpulan dan parameter core values BerAKHLAK.</p>
    </div>

    <!-- Notifikasi Flash Message -->
    @if(session('success'))
      <div class="custom-alert custom-alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="custom-alert custom-alert-danger">
        <strong>Terjadi kesalahan input:</strong>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Card Form Buat Periode Penilaian Baru -->
    <div class="custom-card">
      <div class="custom-card-header">
        <h4 style="color: var(--danger);">
          <i class="bi bi-plus-circle-fill"></i> Buat Periode Penilaian Baru
        </h4>
      </div>
      
      <div class="custom-card-body">
        <form action="{{ route('setting.store') }}" method="POST">
          @csrf
          
          <div class="custom-row">
            <div class="custom-col">
              <div class="custom-form-group">
                <label class="custom-label">Periode Pengumpulan</label>
                <input type="text" name="periode" class="custom-input" placeholder="Contoh: 2026 07" required>
                <div class="custom-help-text">Format penulisan: YYYY MM (Contoh: 2026 07)</div>
              </div>
            </div>

            <div class="custom-col">
              <div class="custom-form-group">
                <label class="custom-label">Core Value</label>
                <select name="value" class="custom-select" required>
                  <option value="" disabled selected>-- Pilih Core Value BerAKHLAK --</option>
                  @foreach($settings as $setting)
                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                  @endforeach
                </select>
                <div class="custom-help-text">Pilihan bersumber dari data database</div>
              </div>
            </div>
          </div>
          
          <div class="custom-row">
            <div class="custom-col">
              <div class="custom-form-group">
                <label class="custom-label">Pilihan Maksimal Pegawai</label>
                <input type="number" name="jum_pilihan" class="custom-input" min="1" placeholder="0" required>
                <div class="custom-help-text">Parameter: jum_pilihan</div>
              </div>
            </div>
            <div class="custom-col">
              <div class="custom-form-group">
                <label class="custom-label">Implementasi Tersedia</label>
                <input type="number" name="max_pilihan" class="custom-input" min="1" placeholder="0" required>
                <div class="custom-help-text">Parameter: max_pilihan</div>
              </div>
            </div>
            <div class="custom-col">
              <div class="custom-form-group">
                <label class="custom-label">Kuota Jumlah Pemenang</label>
                <input type="number" name="kuota_pemenang" class="custom-input" min="1" placeholder="0" required>
                <div class="custom-help-text">Jumlah kuota pemenang per periode</div>
              </div>
            </div>
          </div>

          <button type="submit" class="custom-btn custom-btn-danger" style="margin-top: 1rem;">
            Simpan & Otomatis Aktifkan Periode
          </button>
        </form>
      </div>
    </div>

    <!-- Card Tabel Riwayat Parameter Pengaturan -->
    <div class="custom-card">
      <div class="custom-card-header">
        <h5 style="color: var(--text-main);">
          <i class="bi bi-clock-history" style="color: var(--primary);"></i> Riwayat Parameter Pengaturan
        </h5>
      </div>
      
      <div class="custom-card-body" style="padding: 0;">
        <div class="custom-table-responsive">
          <table class="custom-table">
            <thead>
              <tr>
                <th style="padding-left: 1.5rem;">Periode</th>
                <th>Core Value</th>
                <th class="text-center">Pilihan Max</th>
                <th class="text-center">Tersedia</th>
                <th class="text-center">Kuota Pemenang</th>
                <th class="text-center">Status</th>
                <th class="text-center" style="padding-right: 1.5rem; width: 140px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($riwayatSettings ?? [] as $riwayat)
                <tr>
                  <td style="padding-left: 1.5rem; font-weight: 600;">{{ $riwayat->periode }}</td>
                  <td>{{ $riwayat->value }}</td>
                  <td class="text-center">
                    <span class="custom-badge badge-light">{{ $riwayat->jum_pilihan }} Kriteria</span>
                  </td>
                  <td class="text-center">
                    <span class="custom-badge badge-light">{{ $riwayat->max_pilihan }} Terdisplay</span>
                  </td>
                  <td class="text-center">
                    <span class="custom-badge badge-light">{{ $riwayat->kuota_pemenang ?? 1 }} Pegawai</span>
                  </td>
                  <td class="text-center">
                    @if($riwayat->status == 'aktif')
                      <span class="custom-badge badge-success">aktif</span>
                    @else
                      <span class="custom-badge badge-secondary">tidak aktif</span>
                    @endif
                  </td>
                  <td class="text-center" style="padding-right: 1.5rem;">
                    @if($riwayat->status == 'aktif')
                      <button class="custom-badge badge-success" style="border:none; cursor:default; width: 100px;">
                        Aktif
                      </button>
                    @else
                      <form action="{{ route('setting.aktifkan', $riwayat->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="custom-btn custom-btn-primary" style="width: 100px; border-radius: 50px;">
                          Aktifkan
                        </button>
                      </form>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center" style="padding: 3rem; color: var(--text-muted);">
                    Belum ada riwayat parameter pengaturan yang tersimpan.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection