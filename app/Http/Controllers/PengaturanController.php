<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Halaman pengaturan + riwayat periode
     */
    public function index()
    {
        $riwayatSettings = Setting::orderBy('created_at', 'desc')->get();

        return view('pengaturan.app', compact('riwayatSettings'));
    }

    /**
     * Simpan periode baru dan otomatis aktifkan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode'     => 'required|string|max:20|unique:mongodb.settings,periode',
            'value'       => 'required|string|in:Berorientasi Pelayanan,Akuntabel,Kompeten,Harmonis,Loyal,Adaptif,Kolaboratif',
            'jum_pilihan' => 'required|integer|min:1',
            'max_pilihan' => 'required|integer|min:1',
            'pemenang'    => 'required|integer|min:1',
        ]);

        // Nonaktifkan semua periode lain, lalu aktifkan yang baru
        Setting::where('status', 'aktif')->update(['status' => 'tidak aktif']);

        Setting::create($validated + ['status' => 'aktif']);

        return redirect()
            ->route('pengaturan.app')
            ->with('success', 'Periode berhasil disimpan dan diaktifkan.');
    }

    /**
     * Aktifkan periode dari riwayat
     */
    public function aktifkan(string $id)
    {
        $setting = Setting::findOrFail($id);

        Setting::where('status', 'aktif')->update(['status' => 'tidak aktif']);

        $setting->update(['status' => 'aktif']);

        return redirect()
            ->route('pengaturan.app')
            ->with('success', "Periode {$setting->periode} berhasil diaktifkan.");
    }
}