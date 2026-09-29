<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Menyimpan periode penilaian baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode' => [
                'required',
                'string',
            ],

            'value' => [
                'required',
                'string',
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
        | Nonaktifkan periode aktif sebelumnya
        |--------------------------------------------------------------------------
        */

        Setting::where('status', 'aktif')
            ->update([
                'status' => 'tidak aktif',
            ]);


        /*
        |--------------------------------------------------------------------------
        | Simpan periode baru
        |--------------------------------------------------------------------------
        */

        Setting::create([
            'periode' => $validated['periode'],
            'value' => $validated['value'],
            'jum_pilihan' => (int) $validated['jum_pilihan'],
            'max_pilihan' => (int) $validated['max_pilihan'],
            'kuota_pemenang' => (int) $validated['kuota_pemenang'],
            'status' => 'aktif',
        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Periode penilaian berhasil dibuat dan sekarang aktif.'
            );
    }


    /**
     * Mengaktifkan periode tertentu
     */
    public function aktifkan($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Nonaktifkan semua periode
        |--------------------------------------------------------------------------
        */

        Setting::where('status', 'aktif')
            ->update([
                'status' => 'tidak aktif',
            ]);


        /*
        |--------------------------------------------------------------------------
        | Cari periode
        |--------------------------------------------------------------------------
        */

        $setting = Setting::find($id);

        if (!$setting) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data periode penilaian tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Aktifkan periode
        |--------------------------------------------------------------------------
        */

        $setting->update([
            'status' => 'aktif',
        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Periode penilaian berhasil diaktifkan.'
            );
    }
}