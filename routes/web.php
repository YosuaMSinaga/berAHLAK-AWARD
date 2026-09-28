<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SettingController; // <-- Controller baru untuk pengaturan/setting
use App\Http\Controllers\ProfileController;
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
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD & PENILAIAN (ADMIN & USER)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PENILAIAN (Dapat diakses Admin dan User)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,user')->group(function () {
        Route::resource('penilaian', PenilaianController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | SETTING / PENGATURAN PERIODE PENILAIAN (TAMBAHAN BARU)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::post('/setting', [SettingController::class, 'store'])->name('setting.store');
        Route::patch('/setting/{id}/aktifkan', [SettingController::class, 'aktifkan'])->name('setting.aktifkan');
    });

    /*
    |--------------------------------------------------------------------------
    | USER SPECIFIC ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:user')->group(function () {

        Route::get('/user/dashboard', function () {
            $totalPenilaian = Penilaian::count();
            return view('dashboard.user', compact('totalPenilaian'));
        })->name('user.dashboard');

        // === ROUTE PROFIL KHUSUS USER ===
        Route::get('/profil', [ProfileController::class, 'edit'])->name('profil');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');

        // === ROUTE TAMBAHAN UNTUK USER ===
        Route::get('/monitoring-eksekutif', function () {
            return view('monitoring.eksekutif'); 
        })->name('monitoring.eksekutif');

        Route::get('/pemenang-sertifikat', function () {
            return view('pemenang.sertifikat'); 
        })->name('pemenang.sertifikat');

        Route::get('/pengolahan-data', function () {
            return view('pengolahan.data'); 
        })->name('pengolahan.data');

        Route::get('/pengaturan-aplikasi', function () {
            return view('pengaturan.app'); 
        })->name('pengaturan.app');

    });

    /*
    |--------------------------------------------------------------------------
    | VIEWER
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:viewer')->group(function () {
        Route::get('/viewer/penilaian', [PenilaianController::class, 'index'])->name('viewer.penilaian');
    });

});