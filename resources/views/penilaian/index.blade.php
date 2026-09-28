@extends('layouts.app')

@section('title', 'Data Penilaian')

@section('content')

<!-- Custom CSS Biasa -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&display=swap');
    :root {
        --primary-color: #2563eb;
        --primary-hover: #1d4ed8;
        --danger-color: #dc2626;
        --danger-hover: #b91c1c;
        --success-bg: #dcfce7;
        --success-text: #166534;
        --bg-color: #f8fafc;
        --card-bg: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --radius: 10px;
    }

    .penilaian-container {
        padding: 1.5rem;
        background-color: var(--bg-color);
        min-height: 80vh;
        font-family: 'Lato', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-main);
    }

    /* Topbar */
    .penilaian-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .penilaian-topbar h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0 0 0.25rem 0;
    }

    .penilaian-topbar p {
        color: var(--text-muted);
        margin: 0;
        font-size: 0.95rem;
    }

    .btn-tambah {
        background-color: var(--primary-color);
        color: white;
        padding: 10px 18px;
        border-radius: var(--radius);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        transition: background-color 0.2s, transform 0.1s;
    }

    .btn-tambah:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
    }

    /* Alert Success */
    .alert-success {
        background-color: var(--success-bg);
        color: var(--success-text);
        padding: 14px 18px;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        font-weight: 500;
        border-left: 5px solid #22c55e;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    /* Card & Table Wrapper */
    .penilaian-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .table-responsive {
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
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        padding: 14px 16px;
        border-bottom: 2px solid var(--border-color);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
    }

    .custom-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
        vertical-align: middle;
    }

    .custom-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badge Status */
    .badge-status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .badge-status.lulus, .badge-status.baik, .badge-status.aktif {
        background-color: #dcfce7;
        color: #166534;
    }
    .badge-status.pending, .badge-status.cukup {
        background-color: #fef9c3;
        color: #854d0e;
    }
    .badge-status.tidak, .badge-status.kurang, .badge-status.gagal {
        background-color: #fee2e2;
        color: #991b1b;
    }

    /* Action Buttons */
    .action-group {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-action-edit {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 6px 12px;
        border-radius: 6px;
        background-color: #eff6ff;
        transition: background 0.2s;
    }

    .btn-action-edit:hover {
        background-color: #dbeafe;
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: var(--danger-color);
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: var(--danger-hover);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
        font-style: italic;
    }
</style>

<div class="penilaian-container">

    <div class="penilaian-topbar">
        <div>
            <h1>Data Penilaian</h1>
            <p>Kelola data penilaian kinerja dengan mudah dan terstruktur</p>
        </div>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('penilaian.create') }}" class="btn-tambah">
                + Tambah Penilaian
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="penilaian-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama</th>
                        <th width="25%">Jabatan</th>
                        <th width="15%">Nilai</th>
                        <th width="15%">Status</th>
                        @if(auth()->user()->role === 'admin')
                            <th width="15%">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($penilaian as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->nama }}</strong></td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->nilai }}</td>
                            <td>
                                <!-- Otomatis menyesuaikan warna badge berdasarkan isi teks status -->
                                <span class="badge-status {{ strtolower($item->status) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            @if(auth()->user()->role === 'admin')
                                <td>
                                    <div class="action-group">
                                        <a href="{{ route('penilaian.edit', $item) }}" class="btn-action-edit">
                                            Edit
                                        </a>

                                        <form action="{{ route('penilaian.destroy', $item) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                Belum ada data penilaian yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection