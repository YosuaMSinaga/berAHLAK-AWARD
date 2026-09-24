@extends('layouts.app')

@section('title', 'Data Penilaian')

@section('content')

<div class="topbar">

    <div>

        <h1>Data Penilaian</h1>

        <p>
            Kelola data penilaian
        </p>

    </div>

    @if(auth()->user()->role === 'admin')

        <a
            href="{{ route('penilaian.create') }}"
            style="
                background:#2563eb;
                color:white;
                padding:12px 18px;
                border-radius:8px;
                text-decoration:none;
            "
        >
            + Tambah Penilaian
        </a>

    @endif

</div>


@if(session('success'))

    <div
        style="
            background:#dcfce7;
            color:#166534;
            padding:15px;
            border-radius:8px;
            margin-bottom:20px;
        "
    >

        {{ session('success') }}

    </div>

@endif


<div class="card">

    <table
        width="100%"
        cellpadding="12"
        cellspacing="0"
    >

        <thead>

            <tr>

                <th align="left">
                    No
                </th>

                <th align="left">
                    Nama
                </th>

                <th align="left">
                    Jabatan
                </th>

                <th align="left">
                    Nilai
                </th>

                <th align="left">
                    Status
                </th>

                @if(auth()->user()->role === 'admin')

                    <th>
                        Aksi
                    </th>

                @endif

            </tr>

        </thead>

        <tbody>

            @forelse($penilaian as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->nama }}
                    </td>

                    <td>
                        {{ $item->jabatan }}
                    </td>

                    <td>
                        {{ $item->nilai }}
                    </td>

                    <td>
                        {{ ucfirst($item->status) }}
                    </td>

                    @if(auth()->user()->role === 'admin')

                        <td>

                            <a
                                href="{{ route('penilaian.edit', $item) }}"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('penilaian.destroy', $item) }}"
                                method="POST"
                                style="display:inline"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="
                                        return confirm(
                                            'Hapus data ini?'
                                        )
                                    "
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    @endif

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        align="center"
                    >
                        Belum ada data penilaian.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection