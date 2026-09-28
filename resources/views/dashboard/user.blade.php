@extends('layouts.app')

@section('title', 'Dashboard - BerAKHLAK Award')

@section('content')
<div class="custom-dashboard-wrapper">

    {{-- HEADER HALAMAN & NAVIGASI TAB --}}
    <div class="dash-header-flex">
        <div class="dash-title-group">
            <h2>Dashboard User</h2>
            <p class="text-muted mb-0">
                Selamat datang, <span class="fw-semibold text-success">{{ auth()->user()->name ?? 'User' }}</span>
            </p>
        </div>
        <div class="dash-nav-container">
            <ul id="dashboardTabs" role="tablist" class="custom-tab-list">
                <li role="presentation">
                    <button
                        id="umum-tab"
                        type="button"
                        role="tab"
                        aria-controls="umum-view"
                        aria-selected="true"
                        class="custom-tab-btn active"
                    >
                        Umum
                    </button>
                </li>
                <li role="presentation">
                    <button
                        id="pribadi-tab"
                        type="button"
                        role="tab"
                        aria-controls="pribadi-view"
                        aria-selected="false"
                        class="custom-tab-btn"
                    >
                        Pribadi
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div id="dashboardTabsContent">

        {{-- TAB 1 : DASHBOARD UMUM (Memanggil umum.blade.php di dalam folder dashboard/page) --}}
        <div
            id="umum-view"
            role="tabpanel"
            aria-labelledby="umum-tab"
            class="tab-pane-custom active-pane"
        >
            @include('dashboard.page.umum')
        </div>

        {{-- TAB 2 : DASHBOARD PRIBADI (Memanggil pribadi.blade.php di dalam folder dashboard/page) --}}
        <div
            id="pribadi-view"
            role="tabpanel"
            aria-labelledby="pribadi-tab"
            class="tab-pane-custom"
        >
            @include('dashboard.page.pribadi')
        </div>

    </div>
</div>

{{-- Styling Khusus Dashboard (Full-Width & Clean Layout) --}}
<style>
    .custom-dashboard-wrapper { 
        padding: 24px; 
        font-family: inherit; 
        color: #333; 
        width: 100% !important; 
        max-width: 100% !important; 
        box-sizing: border-box;
        margin: 0; 
    }
    
    .dash-header-flex { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; margin-bottom: 24px; gap: 15px; }
    .dash-title-group h2 { margin: 0 0 5px 0; font-size: 1.6rem; font-weight: 700; }
    .dash-title-group p { margin: 0; color: #666; font-size: 0.95rem; }
    
    /* Nav Tab Custom */
    .custom-tab-list { display: flex; list-style: none; padding: 4px; background: #f1f3f5; border-radius: 50px; margin: 0; gap: 5px; }
    .custom-tab-btn { background: transparent; border: none; padding: 8px 24px; border-radius: 50px; font-weight: 600; cursor: pointer; color: #555; transition: all 0.3s ease; }
    .custom-tab-btn.active { background: #ffffff; color: #0d6efd; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    
    /* Card Component Supaya Lebar Penuh */
    .custom-card { background: #ffffff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); padding: 24px; margin-bottom: 24px; border: 1px solid #eaeaea; width: 100%; box-sizing: border-box; }
    
    /* Filter Grid */
    .filter-grid { display: flex; flex-wrap: wrap; gap: 20px; align-items: center; }
    .form-group-custom { flex: 1; min-width: 280px; }
    .form-group-custom label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; color: #555; }
    .input-icon-wrapper { display: flex; align-items: center; border: 1px solid #ced4da; border-radius: 8px; overflow: hidden; background: #f8f9fa; }
    .input-icon-wrapper span { padding: 0 14px; background: #e9ecef; border-right: 1px solid #ced4da; display: flex; align-items: center; }
    .custom-select { width: 100%; padding: 10px; border: none; background: transparent; outline: none; }
    .info-badge-box { flex: 1; min-width: 280px; background: #f8f9fa; padding: 12px 16px; border-radius: 8px; border-left: 4px solid #0d6efd; }
    .info-badge-box span { display: block; font-size: 0.8rem; color: #666; }
    .info-badge-box strong { font-size: 1rem; color: #212529; }

    /* Stats Grid Utama (Membentang Penuh) */
    .stats-main-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-bottom: 0px; width: 100%; }
    @media (max-width: 992px) { .stats-main-grid { grid-template-columns: 1fr; } }
    
    .stats-sub-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .stat-item { padding: 20px; border-left: 4px solid #ccc; display: flex; align-items: center; }
    .stat-item.border-green { border-left-color: #198754; }
    .stat-item.border-orange { border-left-color: #ffc107; }
    .stat-item.border-blue { border-left-color: #0dcaf0; }
    .stat-item.border-purple { border-left-color: #6f42c1; }
    .stat-content { display: flex; align-items: center; gap: 15px; width: 100%; }
    .stat-icon { width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; }
    .stat-icon.green { background: rgba(25, 135, 84, 0.1); color: #198754; }
    .stat-icon.orange { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
    .stat-icon.blue { background: rgba(13, 202, 240, 0.1); color: #0dcaf0; }
    .stat-icon.purple { background: rgba(111, 66, 193, 0.1); color: #6f42c1; }
    .stat-text span { font-size: 0.8rem; color: #666; display: block; }
    .stat-text h3, .stat-text h6 { margin: 0; font-weight: 700; color: #333; }

    /* Recap Grid */
    .card-header-custom h5 { margin: 0 0 15px 0; font-size: 1.1rem; font-weight: 700; display: flex; align-items: center; gap: 8px; }
    .recap-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; text-align: center; width: 100%; }
    @media (max-width: 768px) { .recap-grid { grid-template-columns: repeat(2, 1fr); } }
    .recap-box { background: #f8f9fa; padding: 20px; border-radius: 8px; }
    .muted-label { font-size: 0.85rem; color: #666; display: block; margin-bottom: 5px; font-weight: 600; }
    .recap-box h3 { margin: 0; font-weight: 700; color: #0d6efd; font-size: 1.5rem; }

    /* Tables */
    .table-container { width: 100%; overflow-x: auto; }
    .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
    .custom-table th, .custom-table td { padding: 14px 18px; border-bottom: 1px solid #eaeaea; }
    .custom-table th { background: #f8f9fa; font-size: 0.85rem; text-transform: uppercase; color: #555; }
    .text-center-custom { text-align: center; padding: 25px !important; color: #666; }
    
    /* Tabs visibility helper */
    .tab-pane-custom { display: none; width: 100%; }
    .tab-pane-custom.active-pane { display: block; width: 100%; }
    
    .chart-big-container { height: 320px; width: 100%; }
    .canvas-container { max-height: 180px; display: flex; justify-content: center; }
    .persen-label { text-align: center; font-weight: 700; margin-top: 10px; color: #0d6efd; }
    .mb-0 { margin-bottom: 0 !important; }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const umumBtn = document.getElementById("umum-tab");
        const pribadiBtn = document.getElementById("pribadi-tab");
        const umumView = document.getElementById("umum-view");
        const pribadiView = document.getElementById("pribadi-view");

        if (umumBtn && pribadiBtn) {
            umumBtn.addEventListener("click", function () {
                umumBtn.classList.add("active");
                umumBtn.setAttribute("aria-selected", "true");
                pribadiBtn.classList.remove("active");
                pribadiBtn.setAttribute("aria-selected", "false");

                umumView.classList.add("active-pane");
                pribadiView.classList.remove("active-pane");

                if (typeof initDashboardUmum === "function") {
                    initDashboardUmum();
                }
            });

            pribadiBtn.addEventListener("click", function () {
                pribadiBtn.classList.add("active");
                pribadiBtn.setAttribute("aria-selected", "true");
                umumBtn.classList.remove("active");
                umumBtn.setAttribute("aria-selected", "false");

                pribadiView.classList.add("active-pane");
                umumView.classList.remove("active-pane");

                if (typeof loadPersonalDashboard === "function") {
                    loadPersonalDashboard();
                }
            });
        }
    });
</script>
@endpush