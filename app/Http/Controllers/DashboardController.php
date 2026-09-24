<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('dashboard.admin', [
                'totalPenilaian' => Penilaian::count(),
                'selesai' => Penilaian::where('status', 'selesai')->count(),
                'draft' => Penilaian::where('status', 'draft')->count(),
            ]);
        }

        if ($user->role === 'viewer') {
            return view('dashboard.viewer', [
                'totalPenilaian' => Penilaian::count(),
            ]);
        }

        return view('dashboard.user', [
            'totalPenilaian' => Penilaian::count(),
        ]);
    }
}