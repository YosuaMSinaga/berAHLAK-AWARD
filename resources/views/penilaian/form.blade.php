@extends('layouts.app')

@section('title', isset($penilaian) ? 'Edit Penilaian' : 'Tambah Penilaian')

@section('content')

<h1>

    {{ isset($penilaian) ? 'Edit Penilaian' : 'Tambah Penilaian' }}

</h1>

<div class="card">

    <form
        method="POST"
        action="{{
            isset($penilaian)
                ? route('penilaian.update', $penilaian)
                : route('penilaian.store')
        }}"
    >

        @csrf

        @if(isset($penilaian))
            @method('PUT')
        @endif


        <label>
            Nama
        </label>

        <input
            type="text"
            name="nama"
            value="{{ old('nama', $penilaian->nama ?? '') }}"
            required
            style="width:100%;padding:12px;margin:8px 0 20px;"
        >


        <label>
            Jabatan
        </label>

        <input
            type="text"
            name="jabatan"
            value="{{ old('jabatan', $penilaian->jabatan ?? '') }}"
            required
            style="width:100%;padding:12px;margin:8px 0 20px;"
        >


        <label>
            Nilai
        </label>

        <input
            type="number"
            name="nilai"
            min="0"
            max="100"
            value="{{ old('nilai', $penilaian->nilai ?? '') }}"
            required
            style="width:100%;padding:12px;margin:8px 0 20px;"
        >


        <label>
            Keterangan
        </label>

        <textarea
            name="keterangan"
            rows="4"
            style="width:100%;padding:12px;margin:8px 0 20px;"
        >{{ old('keterangan', $penilaian->keterangan ?? '') }}</textarea>


        <label>
            Status
        </label>

        <select
            name="status"
            style="width:100%;padding:12px;margin:8px 0 20px;"
        >

            <option
                value="draft"
                @selected(
                    old(
                        'status',
                        $penilaian->status ?? 'draft'
                    ) === 'draft'
                )
            >
                Draft
            </option>

            <option
                value="selesai"
                @selected(
                    old(
                        'status',
                        $penilaian->status ?? ''
                    ) === 'selesai'
                )
            >
                Selesai
            </option>

        </select>


        <button
            type="submit"
            style="
                background:#2563eb;
                color:white;
                padding:12px 20px;
                border:0;
                border-radius:8px;
                cursor:pointer;
            "
        >

            Simpan

        </button>

    </form>

</div>

@endsection