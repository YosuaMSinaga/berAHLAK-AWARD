<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            return view('dashboard.admin', [
                'totalPenilaian' => Penilaian::count(),
                'selesai' => Penilaian::where('status', 'selesai')->count(),
                'draft' => Penilaian::where('status', 'draft')->count(),
            ]);
        }

        if ($user->role === 'viewer') {
            return view('dashboard.viewer', [ // Sesuaikan jika viewer pakai file viewer.blade.php
                'totalPenilaian' => Penilaian::count(),
            ]);
        }

        // SESUAIKAN DI SINI: Arahkan ke 'dashboard.user' karena file Anda bernama user.blade.php di dalam folder dashboard
        return view('dashboard.user', [
            'totalPenilaian' => Penilaian::count(),
        ]);
    }
}