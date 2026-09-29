@extends('layouts.app')

@section('title', 'Login - BerAKHLAK Award')

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

        {{-- Sisi Kiri --}}
        <div class="login-left-content">
            <h1 class="login-heading">
                Selamat Datang di BerAKHLAK Award
            </h1>

            <p class="login-subtext">
                Sistem penilaian terintegrasi untuk mewujudkan pelayanan
                yang profesional, akuntabel, dan berintegritas tinggi.
            </p>
        </div>

        {{-- Card Login --}}
        <div class="login-card">

            {{-- Logo --}}
            <div class="login-logo-wrapper">
                <div class="login-logo-box">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                        />
                    </svg>
                </div>
            </div>

            {{-- Judul --}}
            <div class="login-card-header">
                <h2>Masuk Akun</h2>
                <p>Silakan masukkan username dan password Anda</p>
            </div>

            {{-- Error Session --}}
            @if(session('error'))
                <div class="alert-error-session">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>

                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Success Session --}}
            @if(session('success'))
                <div class="alert-success-session">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Form Login --}}
            <form
                action="{{ route('login.process') }}"
                method="POST"
                class="login-form"
            >
                @csrf

                {{-- Username --}}
                <div class="form-group">

                    <label class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autocomplete="username"
                        placeholder="Masukkan Username Anda"
                        class="form-input @error('username') is-invalid @enderror"
                    >

                    @error('username')
                        <span class="form-error-text">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                {{-- Password --}}
                <div
                    class="form-group"
                    x-data="{ showPassword: false }"
                >

                    <label class="form-label">
                        Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="form-input @error('password') is-invalid @enderror"
                        >

                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="password-toggle-btn"
                            :aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'"
                        >

                            <svg
                                x-show="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>

                            <svg
                                x-show="showPassword"
                                x-cloak
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9.878 9.878a3 3 0 104.243 4.243"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 3l18 18"
                                />
                            </svg>

                        </button>

                    </div>

                    @error('password')
                        <span class="form-error-text">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                {{-- Tombol Login --}}
                <button
                    type="submit"
                    class="btn-submit"
                >
                    Masuk
                </button>

            </form>

            {{-- Link Register --}}
            <div class="register-link">
                <span>Belum memiliki akun?</span>
                <a href="{{ route('register') }}">
                    Daftar di sini
                </a>
            </div>

            {{-- Footer --}}
            <p class="login-card-footer">
                &copy; {{ date('Y') }} BerAKHLAK Award. Hak cipta dilindungi.
            </p>

        </div>
    </div>

</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    .login-wrapper {
        flex: 1;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        padding: 2rem 1rem;
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
        margin-bottom: 1.5rem;
        padding: 0.5rem;
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
        text-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        margin-bottom: 0.75rem;
        letter-spacing: -0.025em;
    }

    @media (min-width: 1024px) {
        .login-heading {
            font-size: 2.75rem;
        }
    }

    .login-subtext {
        font-size: 1rem;
        color: #e2e8f0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        line-height: 1.5;
    }

    .login-card {
        background-color: white;
        border-radius: 1.25rem;
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.25);
        width: 100%;
        max-width: 23rem;
        padding: 1.25rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .login-logo-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 0.5rem;
    }

    .login-logo-box {
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 0.875rem;
        background-color: #eef2ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f46e5;
        border: 1px solid #e0e7ff;
    }

    .login-logo-box svg {
        width: 1.35rem;
        height: 1.35rem;
    }

    .login-card-header {
        text-align: center;
        margin-bottom: 1rem;
    }

    .login-card-header h2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .login-card-header p {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 0.2rem;
    }

    .alert-error-session,
    .alert-success-session {
        margin-bottom: 0.75rem;
        padding: 0.6rem;
        font-size: 0.75rem;
        border-radius: 0.6rem;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .alert-error-session {
        color: #b91c1c;
        background-color: #fef2f2;
        border: 1px solid #fecaca;
    }

    .alert-success-session {
        color: #166534;
        background-color: #f0fdf4;
        border: 1px solid #bbf7d0;
    }

    .alert-error-session svg,
    .alert-success-session svg {
        width: 1rem;
        height: 1rem;
        flex-shrink: 0;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 0.55rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-size: 0.65rem;
        font-weight: 600;
        color: #334155;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.2rem;
    }

    .form-input {
        width: 100%;
        box-sizing: border-box;
        padding: 0.5rem 0.75rem;
        border-radius: 0.6rem;
        border: 1px solid #cbd5e1;
        background-color: #f8fafc;
        outline: none;
        font-size: 0.8rem;
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
        font-size: 0.65rem;
        color: #ef4444;
        margin-top: 0.15rem;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-input {
        padding-right: 2.25rem;
    }

    .password-toggle-btn {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        padding-right: 0.6rem;
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
        width: 1rem;
        height: 1rem;
    }

    .btn-submit {
        width: 100%;
        padding: 0.65rem 1rem;
        background-color: #4f46e5;
        color: white;
        font-weight: 600;
        border-radius: 0.6rem;
        border: none;
        cursor: pointer;
        box-shadow: 0 8px 12px -3px rgba(79, 70, 229, 0.3);
        transition: background-color 0.2s;
        font-size: 0.8rem;
        margin-top: 0.2rem;
    }

    .btn-submit:hover {
        background-color: #4338ca;
    }

    .register-link {
        text-align: center;
        margin-top: 0.875rem;
        font-size: 0.75rem;
        color: #64748b;
    }

    .register-link a {
        color: #4f46e5;
        font-weight: 600;
        text-decoration: none;
        margin-left: 0.2rem;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    .login-card-footer {
        text-align: center;
        font-size: 0.65rem;
        color: #94a3b8;
        margin-top: 0.875rem;
        margin-bottom: 0;
    }
</style>

@endsection