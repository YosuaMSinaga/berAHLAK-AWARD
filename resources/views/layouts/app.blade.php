<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Penilaian')</title>

    {{-- Alpine.js (Diperlukan untuk interaksi seperti show/hide password) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- CSS Biasa (Vanilla CSS) --}}
    <style>
        /* Reset & Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Layout Utama (Sticky Footer) */
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #e2e8f0;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4rem;
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            background-color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .brand-icon svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .brand-title {
            font-weight: 700;
            color: #0f172a;
            font-size: 1rem;
            display: block;
        }

        .brand-subtitle {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
            display: block;
            margin-top: -2px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-links {
            display: flex;
            gap: 0.25rem;
        }

        .nav-link {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            color: #475569;
            transition: all 0.15s ease;
        }

        .nav-link:hover {
            color: #0f172a;
            background-color: #f1f5f9;
        }

        .nav-link.active {
            background-color: #eef2ff;
            color: #4f46e5;
        }

        .nav-divider {
            height: 1.5rem;
            width: 1px;
            background-color: #e2e8f0;
        }

        /* Tombol Logout */
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            background-color: #fef2f2;
            color: #dc2626;
            padding: 0.5rem 0.875rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(254, 202, 202, 0.6);
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-logout:hover {
            background-color: #fee2e2;
        }

        .btn-logout svg {
            width: 1rem;
            height: 1rem;
        }

        /* Konten Utama */
        .main-content {
            flex-grow: 1;
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Notifikasi */
        .alert-success {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .alert-error {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: #fff1f2;
            border: 1px solid #fecdd3;
            color: #9f1239;
            border-radius: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.875rem;
        }

        .alert-error ul {
            list-style-type: disc;
            list-style-position: inside;
            margin-top: 0.25rem;
        }

        /* Footer */
        .footer {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1.5rem 0;
            margin-top: auto;
            width: 100%;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #64748b;
        }

        @media (min-width: 640px) {
            .footer-container {
                flex-direction: row;
            }
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        {{-- Navbar Modern --}}
        <nav class="navbar">
            <div class="nav-container">
                
        {{-- Brand / Logo --}}
                <div class="brand-wrapper" style="display: flex; align-items: center; gap: 0.75rem;">
                    <div class="brand-icon" style="width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; background: transparent; box-shadow: none;">
                        <img src="{{ asset('logo/BPS.png') }}" alt="BPS Logo" style="width: 100%; height: 100%; object-fit: contain; display: block;">
                    </div>
                    <div>
                        <span class="brand-title" style="font-weight: 700; color: #000080; font-style: italic; font-size: 1rem; display: block;">BADAN PUSAT STATISTIK</span>
                        <span class="brand-subtitle" style="font-size: 0.75rem; color: #000080; font-style: italic; font-weight: 600; display: block; margin-top: -2px;">KABUPATEN DAIRI</span>
                    </div>
                </div>

                {{-- Menu Navigasi & Auth --}}
                @auth
                    <div class="nav-menu">
                        
                        <div class="nav-links">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('penilaian.index') }}" class="nav-link {{ request()->routeIs('penilaian*') ? 'active' : '' }}">
                                Penilaian
                            </a>
                        </div>

                        <div class="nav-divider"></div>

                        {{-- Tombol Logout --}}
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-logout">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>

                    </div>
                @endauth

            </div>
        </nav>

        {{-- Content Area (Padding dan max-width di-reset khusus halaman login) --}}
        <main class="main-content" @if(request()->routeIs('login')) style="padding: 0; max-width: 100%;" @endif>

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="alert-success" style="margin: 1rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            {{-- Notifikasi Error Validasi Umum --}}
            @if($errors->any() && !request()->routeIs('login'))
                <div class="alert-error" style="margin: 1rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <strong style="display: block; margin-bottom: 0.25rem;">Terjadi beberapa kesalahan:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Konten Utama Halaman (Child Views) --}}
            @yield('content')

        </main>

        {{-- Footer --}}
        <footer class="footer">
            <div class="footer-container">
                <p style="font-weight:700; font-size:0.5 rem;">&copy; {{ date('Y') }} BerAKHLAK Award. Hak cipta dilindungi.</p>
                <p style="font-weight:700; font-size:0.5 rem;">Sistem Penilaian Elektronik</p>
            </div>
        </footer>

    </div>

</body>

</html>