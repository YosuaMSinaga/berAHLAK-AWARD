<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting; // Sesuaikan dengan nama Model setting Anda

class SettingController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'periode' => 'required',
            'value' => 'required',
            'jum_pilihan' => 'required|integer',
            'max_pilihan' => 'required|integer',
            'kuota_pemenang' => 'required|integer',
        ]);

        // Logika menyimpan data pengaturan baru & mengaktifkannya
        // Contoh: Setting::where('status', 'aktif')->update(['status' => 'tidak aktif']);
        // Setting::create([...]);

        return redirect()->back()->with('success', 'Periode penilaian baru berhasil disimpan dan diaktifkan.');
    }

    public function aktifkan($id)
    {
        // Logika mengubah status setting menjadi aktif berdasarkan $id

        return redirect()->back()->with('success', 'Parameter pengaturan berhasil diaktifkan.');
    }
}