<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PemenangController;

use App\Models\Penilaian;


/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()->route('login');

});


/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');


    Route::post('/login', [
        AuthController::class,
        'login'
    ])->name('login.process');


    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

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

Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()
        ->route('login')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');

})
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED
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
        | PENILAIAN
        |--------------------------------------------------------------------------
        */

        Route::get('/penilaian', [
            PenilaianController::class,
            'index'
        ])->name('penilaian.index');


        Route::get('/penilaian/create', [
            PenilaianController::class,
            'create'
        ])->name('penilaian.create');


        Route::post('/penilaian', [
            PenilaianController::class,
            'store'
        ])->name('penilaian.store');


        Route::get('/penilaian/{penilaian}', [
            PenilaianController::class,
            'show'
        ])->name('penilaian.show');


        Route::get('/penilaian/{penilaian}/edit', [
            PenilaianController::class,
            'edit'
        ])->name('penilaian.edit');


        Route::put('/penilaian/{penilaian}', [
            PenilaianController::class,
            'update'
        ])->name('penilaian.update');


        Route::patch('/penilaian/{penilaian}', [
            PenilaianController::class,
            'update'
        ])->name('penilaian.update.patch');


        Route::delete('/penilaian/{penilaian}', [
            PenilaianController::class,
            'destroy'
        ])->name('penilaian.destroy');


        /*
        |--------------------------------------------------------------------------
        | PENGATURAN APLIKASI
        |--------------------------------------------------------------------------
        */

        Route::get('/pengaturan-aplikasi', [
            SettingController::class,
            'index'
        ])->name('pengaturan.app');


        Route::post('/setting', [
            SettingController::class,
            'store'
        ])->name('setting.store');


        Route::patch('/setting/{id}/aktifkan', [
            SettingController::class,
            'aktifkan'
        ])->name('setting.aktifkan');


        /*
        |--------------------------------------------------------------------------
        | PEMENANG & SERTIFIKAT
        |--------------------------------------------------------------------------
        */

        Route::get('/pemenang-sertifikat', [
            PemenangController::class,
            'index'
        ])->name('pemenang.sertifikat');


        Route::get('/pemenang/periode-aktif', [
            PemenangController::class,
            'periodeAktif'
        ])->name('pemenang.periode-aktif');


        Route::get('/pemenang/riwayat', [
            PemenangController::class,
            'riwayat'
        ])->name('pemenang.riwayat');


        Route::post('/pemenang/tetapkan', [
            PemenangController::class,
            'tetapkan'
        ])->name('pemenang.tetapkan');


        Route::post('/pemenang/update-nosertifikat', [
            PemenangController::class,
            'updateNoSertifikat'
        ])->name('pemenang.update-nosert');


        /*
        |--------------------------------------------------------------------------
        | PENGOLAHAN DATA
        |--------------------------------------------------------------------------
        */

        Route::get('/pengolahan-data', function () {

            return view('pengolahan.data');

        })->name('pengolahan.data');

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
                'dashboard.user',
                compact('totalPenilaian')
            );

        })->name('user.dashboard');


        /*
        |--------------------------------------------------------------------------
        | PROFIL USER
        |--------------------------------------------------------------------------
        */

        Route::get('/user/profil', function () {

            return view(
                'dashboard.userpage.profil'
            );

        })->name('profil');


        /*
        |--------------------------------------------------------------------------
        | UPDATE PROFIL USER
        |--------------------------------------------------------------------------
        */

        Route::put('/user/profil', function (Request $request) {

            /*
            |--------------------------------------------------------------------------
            | AMBIL USER YANG SEDANG LOGIN
            |--------------------------------------------------------------------------
            */

            $user = Auth::user();


            /*
            |--------------------------------------------------------------------------
            | CEK USER
            |--------------------------------------------------------------------------
            */

            if (!$user) {

                return redirect()
                    ->route('login')
                    ->with(
                        'error',
                        'Sesi pengguna tidak ditemukan.'
                    );

            }


            /*
            |--------------------------------------------------------------------------
            | VALIDASI
            |--------------------------------------------------------------------------
            */

            $validated = $request->validate([

                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

            ]);


            /*
            |--------------------------------------------------------------------------
            | UPDATE NAMA USER
            |--------------------------------------------------------------------------
            */

            $user->name = $validated['name'];

            $user->save();


            /*
            |--------------------------------------------------------------------------
            | KEMBALI KE HALAMAN PROFIL
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('profil')
                ->with(
                    'success',
                    'Profil berhasil diperbarui.'
                );

        })->name('profil.update');


        /*
        |--------------------------------------------------------------------------
        | PENILAIAN USER
        |--------------------------------------------------------------------------
        */

        Route::get('/user/penilaian', [
            PenilaianController::class,
            'index'
        ])->name('user.penilaian');


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

        /*
        |--------------------------------------------------------------------------
        | PENILAIAN VIEWER
        |--------------------------------------------------------------------------
        */

        Route::get('/viewer/penilaian', [
            PenilaianController::class,
            'index'
        ])->name('viewer.penilaian');

    });

});