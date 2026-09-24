@extends('layouts.app')

@section('title', 'Register - BerAKHLAK Award')

@section('content')

<div class="login-wrapper">

    {{-- Background Image --}}
    <img
        src="{{ asset('images/background.png') }}"
        alt="Background"
        class="login-bg"
    >

    {{-- Overlay Gelap --}}
    <div class="login-overlay"></div>

    {{-- Kontainer Utama --}}
    <div class="login-container">

        {{-- Sisi Kiri (Teks Sambutan) --}}
        <div class="login-left-content">
            <h1 class="login-heading">
                Bergabung dengan BerAKHLAK Award
            </h1>
            <p class="login-subtext">
                Daftarkan akun Anda untuk mengakses sistem penilaian kinerja terintegrasi yang profesional dan akuntabel.
            </p>
        </div>

        {{-- Card Register --}}
        <div class="login-card">

            {{-- Logo --}}
            <div class="login-logo-wrapper">
                <div class="login-logo-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>

            {{-- Judul --}}
            <div class="login-card-header">
                <h2>Buat Akun Baru</h2>
                <p>Silakan isi data diri Anda untuk pendaftaran</p>
            </div>

            {{-- Form Register --}}
            <form action="{{ route('register.process') }}" method="POST" class="login-form">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Masukkan Nama Lengkap"
                        class="form-input @error('name') is-invalid @enderror"
                    >
                    @error('name')
                        <span class="form-error-text">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="Masukkan Email Anda"
                        class="form-input @error('email') is-invalid @enderror"
                    >
                    @error('email')
                        <span class="form-error-text">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group" x-data="{ showPassword: false }">
                    <label class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="form-input @error('password') is-invalid @enderror"
                        >
                        {{-- Tombol Show / Hide Password --}}
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="password-toggle-btn"
                        >
                            {{-- Mata Terbuka --}}
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{-- Mata Tertutup --}}
                            <svg x-show="showPassword" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.878 9.878a3 3 0 104.243 4.243" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="form-error-text">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group" x-data="{ showPasswordConfirm: false }">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="password-wrapper">
                        <input
                            :type="showPasswordConfirm ? 'text' : 'password'"
                            name="password_confirmation"
                            required
                            placeholder="••••••••"
                            class="form-input"
                        >
                        {{-- Tombol Show / Hide Password Confirm --}}
                        <button
                            type="button"
                            @click="showPasswordConfirm = !showPasswordConfirm"
                            class="password-toggle-btn"
                        >
                            {{-- Mata Terbuka --}}
                            <svg x-show="!showPasswordConfirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{-- Mata Tertutup --}}
                            <svg x-show="showPasswordConfirm" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.878 9.878a3 3 0 104.243 4.243" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Tombol Register --}}
                <button type="submit" class="btn-submit">
                    Daftar
                </button>
            </form>

            {{-- Link ke Login --}}
            <div style="text-align: center; margin-top: 1rem; font-size: 0.875rem; color: #64748b;">
                Sudah punya akun? 
                <a href="{{ route('login') }}" style="color: #4f46e5; font-weight: 600; text-decoration: none;">Masuk di sini</a>
            </div>

            {{-- Footer Card --}}
            <p class="login-card-footer">
                &copy; {{ date('Y') }} BerAKHLAK Award. Hak cipta dilindungi.
            </p>

        </div>

    </div>

</div>

{{-- Styling Mengikuti Halaman Login --}}
<style>
    .login-wrapper {
        min-height: calc(100vh - 4rem - 5rem);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        padding: 2rem 1rem;
        width: 100%;
    }

    .login-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    .login-overlay {
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 10;
    }

    .login-container {
        position: relative;
        z-index: 20;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        max-width: 64rem;
        margin: 0 auto;
    }

    @media (min-width: 1024px) {
        .login-container {
            flex-direction: row;
        }
    }

    .login-left-content {
        color: white;
        text-align: center;
        margin-bottom: 2rem;
        padding: 1rem;
        max-width: 32rem;
    }

    @media (min-width: 1024px) {
        .login-left-content {
            text-align: left;
            margin-right: 3rem;
            margin-bottom: 0;
        }
    }

    .login-heading {
        font-size: 2.25rem;
        font-weight: 700;
        text-shadow: 0 4px 6px rgba(0,0,0,0.3);
        margin-bottom: 1rem;
        letter-spacing: -0.025em;
    }

    @media (min-width: 1024px) {
        .login-heading {
            font-size: 3rem;
        }
    }

    .login-subtext {
        font-size: 1.125rem;
        color: #e2e8f0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        line-height: 1.6;
    }

    .login-card {
        background-color: white;
        border-radius: 1.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        width: 100%;
        max-width: 28rem;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .login-logo-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .login-logo-box {
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 1rem;
        background-color: #eef2ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f46e5;
        border: 1px solid #e0e7ff;
    }

    .login-logo-box svg {
        width: 1.75rem;
        height: 1.75rem;
    }

    .login-card-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .login-card-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
    }

    .login-card-header p {
        font-size: 0.875rem;
        color: #64748b;
        margin-top: 0.25rem;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #334155;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.375rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: 1px solid #cbd5e1;
        background-color: #f8fafc;
        outline: none;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .form-input:focus {
        background-color: white;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .form-input.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .form-error-text {
        font-size: 0.75rem;
        color: #ef4444;
        margin-top: 0.25rem;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-input {
        padding-right: 2.5rem;
    }

    .password-toggle-btn {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        padding-right: 0.75rem;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        color: #94a3b8;
    }

    .password-toggle-btn:hover {
        color: #475569;
    }

    .password-toggle-btn svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    .btn-submit {
        width: 100%;
        padding: 0.875rem 1rem;
        background-color: #4f46e5;
        color: white;
        font-weight: 600;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        transition: background-color 0.2s;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .btn-submit:hover {
        background-color: #4338ca;
    }

    .login-card-footer {
        text-align: center;
        font-size: 0.75rem;
        color: #94a3b8;
        margin-top: 1.5rem;
    }
</style>

@endsection