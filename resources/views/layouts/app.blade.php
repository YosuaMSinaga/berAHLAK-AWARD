<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Penilaian')</title>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            font-family: system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .app-layout {
            display: flex;
            flex: 1;
            position: relative;
        }

        /* =========================================================
            NAVBAR
        ========================================================= */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 40;
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #e2e8f0;
        }

        .nav-container {
            max-width: 100% !important;
            padding: 0 1.5rem;
            margin: 0 auto;

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
            background-color: transparent;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .brand-title {
            font-weight: 700;
            color: #000080;
            font-style: italic;
            font-size: 1rem;
            display: block;
        }

        .brand-subtitle {
            font-size: 0.75rem;
            color: #000080;
            font-style: italic;
            font-weight: 600;
            display: block;
            margin-top: -2px;
        }

        .hamburger-btn {
            background: none;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.5rem;
            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #475569;
            transition: all 0.15s ease;
        }

        .hamburger-btn:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        .hamburger-btn svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        /* =========================================================
            PROFILE
        ========================================================= */

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;

            padding: 0.375rem 0.75rem;

            border: 1px solid #e2e8f0;
            border-radius: 9999px;

            background-color: #ffffff;
            color: #334155;

            font-size: 0.875rem;
            font-weight: 500;

            text-decoration: none;
            transition: all 0.15s ease;
        }

        .profile-btn:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        .profile-icon {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;

            background-color: #eef2ff;
            color: #4f46e5;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;
        }

        .profile-icon svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        /* =========================================================
            SIDEBAR
        ========================================================= */

        .sidebar {
            width: 260px;

            background-color: #ffffff;
            border-right: 1px solid #e2e8f0;

            display: flex;
            flex-direction: column;

            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);

            position: sticky;
            top: 4rem;

            height: calc(100vh - 4rem);

            z-index: 30;
            flex-shrink: 0;
        }

        .sidebar.collapsed {
            margin-left: -260px;
        }

        .sidebar-content {
            padding: 1.25rem 1rem;

            display: flex;
            flex-direction: column;
            gap: 1.25rem;

            overflow-y: auto;
            flex-grow: 1;

            padding-bottom: 5rem;
        }

        .sidebar-header-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;

            padding-bottom: 1.25rem;

            border-bottom: 1px solid #f1f5f9;
        }

        .sidebar-header-image img {
            width: 140px;
            height: auto;
            max-height: 90px;
            object-fit: contain;
            margin-bottom: 0.25rem;
        }

        /* =========================================================
            NAVIGATION
        ========================================================= */

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;

            padding: 0.75rem 1rem;

            border-radius: 0.5rem;

            font-size: 0.875rem;
            font-weight: 500;

            text-decoration: none;

            color: #475569;
            background-color: transparent;

            transition: all 0.15s ease;
        }

        .nav-link svg {
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
            color: #64748b;
        }

        .nav-link:hover {
            color: #0f172a;
            background-color: #f1f5f9;
        }

        .nav-link.active {
            background-color: #eef2ff;
            color: #4f46e5;
            font-weight: 600;
        }

        .nav-link.active svg {
            color: #4f46e5;
        }

        /* =========================================================
            SIDEBAR FOOTER
        ========================================================= */

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;

            width: 100%;
            padding: 1rem;

            border-top: 1px solid #e2e8f0;
            background-color: #ffffff;

            z-index: 10;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.75rem;

            padding: 0.75rem 1rem;

            border-radius: 0.5rem;

            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;

            background-color: #dc2626;
            color: #ffffff;

            border: 1px solid #b91c1c;

            cursor: pointer;

            width: 100%;
            text-align: left;
            line-height: 1.25rem;

            transition: background-color 0.2s;
        }

        .btn-logout:hover {
            background-color: #b91c1c;
        }

        .btn-logout svg {
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
            color: #ffffff;
        }

        /* =========================================================
            CONTENT
        ========================================================= */

        .content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .main-content {
            flex-grow: 1;
            width: 100%;

            padding: 2rem 1.5rem;

            display: flex;
            flex-direction: column;
        }

        /* =========================================================
            ALERT
        ========================================================= */

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

        /* =========================================================
            RESPONSIVE
        ========================================================= */

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 4rem;
                height: calc(100vh - 4rem);
            }

            .sidebar.collapsed {
                margin-left: -260px;
            }
        }
    </style>
</head>

<body x-data="{ sidebarOpen: true }">

<div class="page-wrapper">

    {{-- =========================================================
         NAVBAR
    ========================================================= --}}
    <nav class="navbar">
        <div class="nav-container">
            <div class="brand-wrapper">
                @auth
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="hamburger-btn"
                        title="Toggle Sidebar"
                    >
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
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>
                @endauth

                <div class="brand-icon">
                    <img
                        src="{{ asset('logo/BPS.png') }}"
                        alt="BPS Logo"
                    >
                </div>

                <div>
                    <span class="brand-title">
                        BADAN PUSAT STATISTIK
                    </span>
                    <span class="brand-subtitle">
                        KABUPATEN DAIRI
                    </span>
                </div>
            </div>

            {{-- =====================================================
                 PROFILE
            ===================================================== --}}
            @auth
                <div class="nav-right">
                    @if(auth()->user()->role !== 'admin')
                        <a
                            href="{{ route('profil') }}"
                            class="profile-btn"
                            title="Profil Pengguna"
                        >
                            <div class="profile-icon">
                                @if(auth()->user()->foto)
                                    <img
                                        src="{{ auth()->user()->foto }}"
                                        alt="Profil"
                                        style="width:100%;height:100%;object-fit:cover;"
                                    >
                                @else
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
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        />
                                    </svg>
                                @endif
                            </div>
                            <span>
                                {{ auth()->user()->name ?? 'Profil' }}
                            </span>
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </nav>

    {{-- =========================================================
         APP LAYOUT
    ========================================================= --}}
    <div class="app-layout">

        {{-- =====================================================
             SIDEBAR
        ===================================================== --}}
        @auth
            <aside
                class="sidebar"
                :class="{ 'collapsed': !sidebarOpen }"
            >
                <div class="sidebar-content">
                    {{-- Logo Sidebar --}}
                    <div class="sidebar-header-image">
                        <img
                            src="{{ asset('logo/Brand.png') }}"
                            alt="Logo Sidebar"
                        >
                    </div>

                    {{-- =================================================
                         MENU
                    ================================================== --}}
                    <div class="nav-links">

                        {{-- =================================================
                             ADMIN
                        ================================================== --}}
                        @if(auth()->user()->role === 'admin')

                            {{-- Dashboard --}}
                            <a
                                href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            >
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
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                    />
                                </svg>
                                Dashboard
                            </a>

                            {{-- Form Penilaian --}}
                            <a
                                href="{{ route('penilaian.index') }}"
                                class="nav-link {{ request()->routeIs('penilaian.*') ? 'active' : '' }}"
                            >
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
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"
                                    />
                                </svg>
                                Form Penilaian
                            </a>

                            {{-- Pemenang & Sertifikat --}}
                            <a
                                href="{{ route('pemenang.sertifikat') }}"
                                class="nav-link {{ request()->routeIs('pemenang.*') ? 'active' : '' }}"
                            >
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
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                                    />
                                </svg>
                                Pemenang & Sertifikat
                            </a>

                            {{-- Pengolahan Data --}}
                            <a
                                href="{{ route('pengolahan.data') }}"
                                class="nav-link {{ request()->routeIs('pengolahan.*') ? 'active' : '' }}"
                            >
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
                                        d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"
                                    />
                                </svg>
                                Pengolahan Data
                            </a>

                            {{-- Pengaturan Aplikasi --}}
                            <a
                                href="{{ route('pengaturan.app') }}"
                                class="nav-link {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}"
                            >
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
                                        d="M10.325 4.317a1.724 1.724 0 013.35 0 1.724 1.724 0 002.573 1.066 1.724 1.724 0 012.37 2.37 1.724 1.724 0 001.066 2.573 1.724 1.724 0 010 3.35 1.724 1.724 0 00-1.066 2.573 1.724 1.724 0 01-2.37 2.37 1.724 1.724 0 00-2.573 1.066 1.724 1.724 0 01-3.35 0 1.724 1.724 0 00-2.573-1.066 1.724 1.724 0 01-2.37-2.37 1.724 1.724 0 00-1.066-2.573 1.724 1.724 0 010-3.35 1.724 1.724 0 001.066-2.573 1.724 1.724 0 012.37-2.37 1.724 1.724 0 002.573-1.066z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                                Pengaturan Aplikasi
                            </a>

                        {{-- =================================================
                             USER
                        ================================================== --}}
                        @elseif(auth()->user()->role === 'user')

                            {{-- Dashboard User --}}
                            <a
                                href="{{ route('user.dashboard') }}"
                                class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                            >
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
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                    />
                                </svg>
                                Dashboard
                            </a>

                            {{-- Penilaian User --}}
                            <a
                                href="{{ route('user.penilaian') }}"
                                class="nav-link {{ request()->routeIs('user.penilaian*') ? 'active' : '' }}"
                            >
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
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"
                                    />
                                </svg>
                                Penilaian
                            </a>

                        {{-- =================================================
                             VIEWER
                        ================================================== --}}
                        @elseif(auth()->user()->role === 'viewer')

                            {{-- Penilaian Viewer --}}
                            <a
                                href="{{ route('viewer.penilaian') }}"
                                class="nav-link {{ request()->routeIs('viewer.penilaian') ? 'active' : '' }}"
                            >
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
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"
                                    />
                                </svg>
                                Penilaian
                            </a>

                        @endif

                    </div>
                </div>

                {{-- =====================================================
                     LOGOUT
                ===================================================== --}}
                <div class="sidebar-footer">
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        style="width:100%;"
                    >
                        @csrf
                        <button
                            type="submit"
                            class="btn-logout"
                        >
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
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>
        @endauth

        {{-- =====================================================
             CONTENT
        ===================================================== --}}
        <div class="content-wrapper">
            <main
                class="main-content"
                @if(request()->routeIs('login', 'register'))
                    style="padding:0;max-width:100%;"
                @endif
            >
                {{-- SUCCESS --}}
                @if(session('success'))
                    <div
                        class="alert-success"
                        style="margin:1rem;"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            style="width:1.25rem;height:1.25rem;flex-shrink:0;"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <div>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                {{-- ERRORS --}}
                @if($errors->any() && !request()->routeIs('login', 'register'))
                    <div
                        class="alert-error"
                        style="margin:1rem;"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            style="width:1.25rem;height:1.25rem;flex-shrink:0;"
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
                        <div>
                            <strong style="display:block;margin-bottom:0.25rem;">
                                Terjadi beberapa kesalahan:
                            </strong>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- PAGE CONTENT --}}
                @yield('content')
            </main>
        </div>

    </div>

</div>

@stack('scripts')

</body>
</html>