<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PemenangController;
use App\Http\Controllers\ProfilController;

use App\Models\Penilaian;
use App\Models\Olah;
use App\Models\Setting;


/*
|--------------------------------------------------------------------------
| HALAMAN AWAL / ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // LOGIN
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    // REGISTER
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATED
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::post('/logout', function (Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');

    })->name('logout');


    // DASHBOARD UTAMA (diarahkan sesuai role lewat DashboardController)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // DASHBOARD - DATA PERIODE
    Route::get('/dashboard/periode', [
        DashboardController::class,
        'getPeriode'
    ])->name('dashboard.periode');

    Route::get('/dashboard/data', [
        DashboardController::class,
        'getDataByPeriode'
    ])->name('dashboard.data');


    // DASHBOARD - LAPORAN KOMPETENSI PERILAKU PRIBADI
    // Di grup auth (bukan role:*) agar bisa dipanggil admin, user, dan viewer.
    Route::get('/dashboard/laporan-pribadi', [
        DashboardController::class,
        'getLaporanPribadi'
    ])->name('dashboard.laporan-pribadi');


    // PROFIL
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');


    // FORM PENILAIAN UMUM
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::get('/penilaian/form/{setting}', [PenilaianController::class, 'form'])->name('penilaian.form');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian/{penilaian}', [PenilaianController::class, 'show'])->name('penilaian.show');
    Route::get('/penilaian/{penilaian}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('/penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::patch('/penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('penilaian.update.patch');
    Route::delete('/penilaian/{penilaian}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:user')->group(function () {

        // DASHBOARD USER
        Route::get('/user/dashboard', function () {

            $totalPenilaian = Penilaian::count();

            return view('dashboard.user', compact('totalPenilaian'));

        })->name('user.dashboard');

        // DASHBOARD USER - PERIODE
        Route::get('/user/dashboard/periode', [
            DashboardController::class,
            'getPeriode'
        ])->name('user.dashboard.periode');

        Route::get('/user/dashboard/data', [
            DashboardController::class,
            'getDataByPeriode'
        ])->name('user.dashboard.data');

        // PENILAIAN USER
        Route::get('/user/penilaian', [PenilaianController::class, 'index'])->name('user.penilaian');
        Route::get('/user/penilaian/form/{setting}', [PenilaianController::class, 'form'])->name('user.penilaian.form');
        Route::post('/user/penilaian', [PenilaianController::class, 'store'])->name('user.penilaian.store');
        Route::get('/user/penilaian/{penilaian}', [PenilaianController::class, 'show'])->name('user.penilaian.show');

    });


    /*
    |--------------------------------------------------------------------------
    | VIEWER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:viewer')->group(function () {

        Route::get('/viewer/penilaian', [PenilaianController::class, 'index'])->name('viewer.penilaian');

    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        // DATA DASHBOARD ADMIN
        Route::get('/admin/dashboard/periode', [
            DashboardController::class,
            'getPeriode'
        ])->name('admin.dashboard.periode');

        Route::get('/admin/dashboard/data', [
            DashboardController::class,
            'getDataByPeriode'
        ])->name('admin.dashboard.data');

        // PENILAIAN ADMIN
        Route::get('/admin/penilaian', [PenilaianController::class, 'index'])->name('admin.penilaian');
        Route::get('/admin/penilaian/create', [PenilaianController::class, 'create'])->name('admin.penilaian.create');
        Route::get('/admin/penilaian/form/{setting}', [PenilaianController::class, 'form'])->name('admin.penilaian.form');
        Route::post('/admin/penilaian', [PenilaianController::class, 'store'])->name('admin.penilaian.store');


        // PENGOLAHAN DATA
        Route::get('/pengolahan-data', function () {

            // Periode aktif (berdasarkan status 'aktif' di collection settings)
            $settingPeriode = Setting::where('status', 'aktif')->first();

            $periodeAktif = $settingPeriode->periode ?? '2026 06';

            // Data olah berdasarkan periode
            $dataOlah = Olah::where('periode', $periodeAktif)
                ->orderBy('nip', 'asc')
                ->get();

            $jumlahData = $dataOlah->count();

            // Rerata Self = rata-rata skor_berakhlak
            $rerataSelf = $jumlahData > 0 ? $dataOlah->avg('skor_berakhlak') : 0;

            // Rerata Peer = rata-rata skor_rekan_2
            $rerataPeer = $jumlahData > 0 ? $dataOlah->avg('skor_rekan_2') : 0;

            // Rerata Akhir = rata-rata skor_akhir
            $rerataAkhir = $jumlahData > 0 ? $dataOlah->avg('skor_akhir') : 0;

            return view('dashboard.page.Olah', [
                'periodeAktif' => $periodeAktif,
                'dataOlah'     => $dataOlah,
                'jumlahData'   => $jumlahData,
                'rerataSelf'   => $rerataSelf,
                'rerataPeer'   => $rerataPeer,
                'rerataAkhir'  => $rerataAkhir,
            ]);

        })->name('pengolahan.data');


        // PENGATURAN APLIKASI
        Route::get('/pengaturan-aplikasi', [PengaturanController::class, 'index'])->name('pengaturan.app');
        Route::post('/pengaturan-aplikasi', [PengaturanController::class, 'store'])->name('setting.store');
        Route::patch('/pengaturan-aplikasi/{id}/aktifkan', [PengaturanController::class, 'aktifkan'])->name('setting.aktifkan');


        // PEMENANG & SERTIFIKAT
        Route::get('/pemenang-sertifikat', [PemenangController::class, 'index'])->name('pemenang.sertifikat');
        Route::get('/pemenang/periode-aktif', [PemenangController::class, 'periodeAktif'])->name('pemenang.periode-aktif');
        Route::get('/pemenang/riwayat', [PemenangController::class, 'riwayat'])->name('pemenang.riwayat');
        Route::get('/pemenang-sertifikat/preview/{id}', [PemenangController::class, 'preview'])->name('pemenang.preview');
        Route::post('/pemenang/tetapkan', [PemenangController::class, 'tetapkan'])->name('pemenang.tetapkan');
        Route::post('/pemenang/update-nosertifikat', [PemenangController::class, 'updateNoSertifikat'])->name('pemenang.update-nosert');
        Route::put('/pemenang-sertifikat/{id}', [PemenangController::class, 'update'])->name('pemenang.update');
        Route::get('/pemenang-sertifikat/{id}/download', [PemenangController::class, 'download'])->name('pemenang.download');

    });

});