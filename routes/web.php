<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SettingController;

use App\Models\Penilaian;


/*
|--------------------------------------------------------------------------
| LOGIN & REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/login', [
        AuthController::class,
        'login'
    ])->name('login.process');


    // Register
    Route::get('/register', [
        AuthController::class,
        'showRegister'
    ])->name('register');

    Route::post('/register', [
        AuthController::class,
        'register'
    ])->name('register.process');
});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [
    AuthController::class,
    'logout'
])->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            DashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | PENILAIAN ADMIN
        |--------------------------------------------------------------------------
        |
        | Admin dapat:
        | - Melihat daftar penilaian
        | - Membuat penilaian
        | - Menyimpan penilaian
        | - Melihat detail
        | - Mengedit
        | - Mengupdate
        | - Menghapus
        |
        */


        // Daftar penilaian
        Route::get('/penilaian', [
            PenilaianController::class,
            'index'
        ])->name('penilaian.index');


        // Form tambah penilaian
        // HARUS berada sebelum /penilaian/{penilaian}
        Route::get('/penilaian/create', [
            PenilaianController::class,
            'create'
        ])->name('penilaian.create');


        // Simpan penilaian
        Route::post('/penilaian', [
            PenilaianController::class,
            'store'
        ])->name('penilaian.store');


        // Detail penilaian
        Route::get('/penilaian/{penilaian}', [
            PenilaianController::class,
            'show'
        ])->name('penilaian.show');


        // Form edit penilaian
        Route::get('/penilaian/{penilaian}/edit', [
            PenilaianController::class,
            'edit'
        ])->name('penilaian.edit');


        // Update penilaian
        Route::put('/penilaian/{penilaian}', [
            PenilaianController::class,
            'update'
        ])->name('penilaian.update');


        // Update penilaian menggunakan PATCH
        Route::patch('/penilaian/{penilaian}', [
            PenilaianController::class,
            'update'
        ])->name('penilaian.update.patch');


        // Hapus penilaian
        Route::delete('/penilaian/{penilaian}', [
            PenilaianController::class,
            'destroy'
        ])->name('penilaian.destroy');


        /*
        |--------------------------------------------------------------------------
        | PENGATURAN PERIODE
        |--------------------------------------------------------------------------
        |
        | Route ini digunakan oleh form.blade.php:
        |
        | <form action="{{ route('setting.store') }}" method="POST">
        |
        */


        // Simpan / buat periode penilaian baru
        Route::post('/setting', [
            SettingController::class,
            'store'
        ])->name('setting.store');


        // Aktifkan periode tertentu
        Route::patch('/setting/{id}/aktifkan', [
            SettingController::class,
            'aktifkan'
        ])->name('setting.aktifkan');


        /*
        |--------------------------------------------------------------------------
        | FITUR ADMIN
        |--------------------------------------------------------------------------
        */


        // Pemenang & Sertifikat
        Route::get('/pemenang-sertifikat', function () {
            return view('pemenang.sertifikat');
        })->name('pemenang.sertifikat');


        // Pengolahan Data
        Route::get('/pengolahan-data', function () {
            return view('pengolahan.data');
        })->name('pengolahan.data');


        // Pengaturan Aplikasi
        Route::get('/pengaturan-aplikasi', function () {
            return view('pengaturan.app');
        })->name('pengaturan.app');

    });


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:user')->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD USER
        |--------------------------------------------------------------------------
        */

        Route::get('/user/dashboard', function () {

            $totalPenilaian = Penilaian::count();

            return view(
                'dashboard.userpage.user',
                compact('totalPenilaian')
            );

        })->name('user.dashboard');


        /*
        |--------------------------------------------------------------------------
        | USER HANYA MELIHAT PENILAIAN
        |--------------------------------------------------------------------------
        |
        | User TIDAK mempunyai akses:
        | - create
        | - store
        | - edit
        | - update
        | - destroy
        |
        */


        // Daftar penilaian
        Route::get('/user/penilaian', [
            PenilaianController::class,
            'index'
        ])->name('user.penilaian');


        // Detail penilaian
        Route::get('/user/penilaian/{penilaian}', [
            PenilaianController::class,
            'show'
        ])->name('user.penilaian.show');

    });


    /*
    |--------------------------------------------------------------------------
    | VIEWER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:viewer')->group(function () {


        // Viewer hanya dapat melihat daftar penilaian
        Route::get('/viewer/penilaian', [
            PenilaianController::class,
            'index'
        ])->name('viewer.penilaian');

    });

});