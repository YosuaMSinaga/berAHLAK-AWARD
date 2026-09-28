@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div style="width: 100%;">

    {{-- Kartu Utama Profil (Lebar Penuh) --}}
    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05); width: 100%;">
        
        {{-- Bagian Info Singkat & Foto Profil --}}
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #f1f5f9;">
            
            {{-- PERUBAHAN: Ukuran diperbesar dari 5rem menjadi 8rem (sekitar 128px) --}}
            <div style="width: 8rem; height: 8rem; min-width: 8rem; min-height: 8rem; border-radius: 50%; background-color: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid #e2e8f0;">
                @if(auth()->user()->foto)
                    {{-- Tampilkan foto dari Base64 jika ada --}}
                    <img src="{{ auth()->user()->foto }}" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 4rem; height: 4rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                @endif
            </div>

            <div>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 0.25rem;">{{ auth()->user()->name }}</h2>
                <p style="font-size: 0.875rem; color: #64748b;">{{ auth()->user()->email }}</p>
                <span style="display: inline-block; margin-top: 0.5rem; padding: 0.25rem 0.75rem; background-color: #eef2ff; color: #4f46e5; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                    Role: {{ ucfirst(auth()->user()->role ?? 'User') }}
                </span>
            </div>
        </div>

        {{-- Form CRUD Update Profil --}}
        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <h3 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-bottom: 1.25rem;">Edit Informasi Akun</h3>

            <div style="display: grid; grid-template-columns: 1fr; gap: 1.25rem; margin-bottom: 1.75rem;">
                
                {{-- Input Foto Profil (Base64 Converter) --}}
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #334155; margin-bottom: 0.375rem;">Ubah Foto Profil</label>
                    <input type="file" id="input-foto-file" accept="image/*" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.875rem; background-color: #f8fafc;">
                    {{-- Input hidden untuk menampung string base64 yang dikirim ke controller --}}
                    <input type="hidden" name="foto" id="foto_base64">
                </div>

                {{-- Nama / Username --}}
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #334155; margin-bottom: 0.375rem;">Nama / Username</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.875rem; color: #1e293b; background-color: #ffffff; outline: none;">
                </div>

                {{-- Email --}}
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #334155; margin-bottom: 0.375rem;">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.875rem; color: #1e293b; background-color: #ffffff; outline: none;">
                </div>

                {{-- NIP --}}
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #334155; margin-bottom: 0.375rem;">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip', auth()->user()->nip ?? '') }}" placeholder="Masukkan NIP Anda" style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.875rem; color: #1e293b; background-color: #ffffff; outline: none;">
                </div>

                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #334155; margin-bottom: 0.375rem;">Jabatan</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', auth()->user()->jabatan ?? '') }}" placeholder="Masukkan Jabatan Anda" style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.875rem; color: #1e293b; background-color: #ffffff; outline: none;">
                </div>

            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="submit" style="padding: 0.625rem 1.25rem; background-color: #008000; color: #ffffff; border: none; border-radius: 0.5rem; font-weight: 500; font-size: 0.875rem; cursor: pointer;">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

{{-- Skrip untuk Mengubah File Gambar ke Base64 secara Otomatis --}}
<script>
    document.getElementById('input-foto-file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Masukkan hasil konversi string Base64 ke input hidden
                document.getElementById('foto_base64').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection