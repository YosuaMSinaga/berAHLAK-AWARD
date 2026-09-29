<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman Pengaturan Periode Penilaian.
     */
    public function index()
    {
        // Mengambil setting yang sedang aktif
        $settings = Setting::where('status', 'aktif')
            ->orderBy('value', 'asc')
            ->get();

        // Mengambil seluruh riwayat setting
        $riwayatSettings = Setting::orderBy('periode', 'desc')
            ->orderBy('value', 'asc')
            ->get();

        return view('pengaturan.app', [
            'settings' => $settings,
            'riwayatSettings' => $riwayatSettings,
        ]);
    }

    /**
     * Menyimpan pengaturan baru.
     *
     * 1 kali submit form = 1 data Setting.
     */
    public function store(Request $request)
    {
        // Validasi data dari form
        $validated = $request->validate([
            'periode' => [
                'required',
                'string',
                'max:20',
            ],

            'value' => [
                'required',
                'string',
                'max:100',
            ],

            'jum_pilihan' => [
                'required',
                'integer',
                'min:1',
            ],

            'max_pilihan' => [
                'required',
                'integer',
                'min:1',
            ],

            'kuota_pemenang' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Nonaktifkan setting yang sebelumnya aktif
        |--------------------------------------------------------------------------
        |
        | Jika membuat setting baru, setting aktif sebelumnya
        | akan menjadi tidak aktif.
        |
        */
        Setting::where('status', 'aktif')
            ->update([
                'status' => 'tidak aktif',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Simpan SATU data sesuai isi form
        |--------------------------------------------------------------------------
        |
        | Tidak ada foreach.
        | Tidak membuat 7 Core Value secara otomatis.
        |
        */
        Setting::create([
            'periode' => $validated['periode'],
            'value' => $validated['value'],
            'jum_pilihan' => (int) $validated['jum_pilihan'],
            'max_pilihan' => (int) $validated['max_pilihan'],
            'kuota_pemenang' => (int) $validated['kuota_pemenang'],

            'status' => 'aktif',

            // Nilai awal perhitungan
            'avgberakhlak' => 0,
            'avgpeer' => 0,
            'avgakhir' => 0,
            'korelasi' => 0,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman pengaturan
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('pengaturan.app')
            ->with(
                'success',
                'Parameter pengaturan berhasil disimpan.'
            );
    }

    /**
     * Mengaktifkan kembali setting tertentu.
     */
    public function aktifkan($id)
    {
        // Cari data berdasarkan ID
        $setting = Setting::find($id);

        // Jika data tidak ditemukan
        if (!$setting) {
            return redirect()
                ->route('pengaturan.app')
                ->with(
                    'error',
                    'Data pengaturan tidak ditemukan.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Nonaktifkan semua setting yang sedang aktif
        |--------------------------------------------------------------------------
        */
        Setting::where('status', 'aktif')
            ->update([
                'status' => 'tidak aktif',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Aktifkan setting yang dipilih
        |--------------------------------------------------------------------------
        */
        $setting->update([
            'status' => 'aktif',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman pengaturan
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('pengaturan.app')
            ->with(
                'success',
                'Pengaturan "' .
                $setting->value .
                '" pada periode ' .
                $setting->periode .
                ' berhasil diaktifkan.'
            );
    }
}