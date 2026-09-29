<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Penilaian;
use App\Models\Setting;
use App\Models\User; // Menggunakan model User untuk role 'user'
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | Menampilkan seluruh data penilaian atau form utama.
    */
    public function index()
    {
        $penilaians = Penilaian::orderBy('timestamp', 'desc')->get();

        // Pengaturan aktif
        $settings = Setting::where('status', 'aktif')
            ->orderBy('value', 'asc')
            ->get();

        // Riwayat pengaturan
        $riwayatSettings = Setting::orderBy('periode', 'desc')
            ->orderBy('value', 'asc')
            ->get();

        // Ambil setting aktif pertama untuk kompatibilitas form
        $settingAktif = $settings->first();

        // Ambil data implementasi/nilai berdasarkan core value aktif
        $implementasi = $settingAktif 
            ? Nilai::where('value', $settingAktif->value)->orderBy('id', 'asc')->get() 
            : collect();

        // Ambil data user yang memiliki role 'user'
        $pegawai = User::where('role', 'user')->orderBy('name', 'asc')->get();

        return view('penilaian.index', [
            'penilaians' => $penilaians,
            'penilaian' => $penilaians,
            'settings' => $settings,
            'settingAktif' => $settingAktif,
            'riwayatSettings' => $riwayatSettings,
            'implementasi' => $implementasi,
            'pegawai' => $pegawai,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    | Menampilkan form tambah penilaian.
    */
    public function create()
    {
        $settings = Setting::where('status', 'aktif')
            ->orderBy('value', 'asc')
            ->get();

        if ($settings->isEmpty()) {
            return redirect()
                ->route('penilaian.index')
                ->with('error', 'Belum ada periode penilaian yang aktif.');
        }

        $settingAktif = $settings->first();
        $periode = $settingAktif->periode;

        $coreValues = [
            'Berorientasi Pelayanan',
            'Akuntabel',
            'Kompeten',
            'Harmonis',
            'Loyal',
            'Adaptif',
            'Kolaboratif',
        ];

        $nilai = Nilai::orderBy('id', 'asc')->get();
        $nilaiGrouped = $nilai->groupBy('value');
        $implementasi = $nilai->where('value', $settingAktif->value);
        
        // Ambil data user dengan role 'user'
        $pegawai = User::where('role', 'user')->orderBy('name', 'asc')->get();
        
        $riwayatSettings = Setting::orderBy('periode', 'desc')
            ->orderBy('value', 'asc')
            ->get();

        return view('penilaian.form', [
            'settings' => $settings,
            'settingAktif' => $settingAktif,
            'periode' => $periode,
            'coreValues' => $coreValues,
            'nilaiGrouped' => $nilaiGrouped,
            'implementasi' => $implementasi,
            'pegawai' => $pegawai,
            'riwayatSettings' => $riwayatSettings,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    | Menyimpan penilaian baru ke database.
    */
    public function store(Request $request)
    {
        $settings = Setting::where('status', 'aktif')
            ->orderBy('value', 'asc')
            ->get();

        if ($settings->isEmpty()) {
            return redirect()
                ->back()
                ->with('error', 'Belum ada periode penilaian yang aktif.');
        }

        $validated = $request->validate([
            'pilihan_berakhlak' => [
                'required',
                'array',
            ],
            'pilihan_pegawai' => [
                'required',
                'array',
            ],
        ]);

        $data = [
            'timestamp' => now(),
            'periode' => $settings->first()->periode,
            'value' => $settings->first()->value,
            'pilihan_berakhlak' => $validated['pilihan_berakhlak'],
            'pilihan_pegawai' => $validated['pilihan_pegawai'],
        ];

        Penilaian::create($data);

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Data penilaian berhasil disimpan.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | Menampilkan detail penilaian.
    */
    public function show($id)
    {
        $penilaian = Penilaian::find($id);

        if (!$penilaian) {
            return redirect()
                ->route('penilaian.index')
                ->with('error', 'Data penilaian tidak ditemukan.');
        }

        return view('penilaian.show', [
            'penilaian' => $penilaian,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    | Menampilkan form edit penilaian.
    */
    public function edit($id)
    {
        $penilaian = Penilaian::find($id);

        if (!$penilaian) {
            return redirect()
                ->route('penilaian.index')
                ->with('error', 'Data penilaian tidak ditemukan.');
        }

        $settings = Setting::where('status', 'aktif')
            ->orderBy('value', 'asc')
            ->get();

        if ($settings->isEmpty()) {
            return redirect()
                ->route('penilaian.index')
                ->with('error', 'Belum ada periode penilaian yang aktif.');
        }

        $settingAktif = $settings->first();
        $periode = $settingAktif->periode;

        $coreValues = [
            'Berorientasi Pelayanan',
            'Akuntabel',
            'Kompeten',
            'Harmonis',
            'Loyal',
            'Adaptif',
            'Kolaboratif',
        ];

        $nilai = Nilai::orderBy('id', 'asc')->get();
        $nilaiGrouped = $nilai->groupBy('value');
        $implementasi = $nilai->where('value', $settingAktif->value);
        
        // Ambil data user dengan role 'user'
        $pegawai = User::where('role', 'user')->orderBy('name', 'asc')->get();

        $riwayatSettings = Setting::orderBy('periode', 'desc')
            ->orderBy('value', 'asc')
            ->get();

        return view('penilaian.form', [
            'penilaian' => $penilaian,
            'settings' => $settings,
            'settingAktif' => $settingAktif,
            'periode' => $periode,
            'coreValues' => $coreValues,
            'nilaiGrouped' => $nilaiGrouped,
            'implementasi' => $implementasi,
            'pegawai' => $pegawai,
            'riwayatSettings' => $riwayatSettings,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    | Memperbarui penilaian.
    */
    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::find($id);

        if (!$penilaian) {
            return redirect()
                ->route('penilaian.index')
                ->with('error', 'Data penilaian tidak ditemukan.');
        }

        $settings = Setting::where('status', 'aktif')
            ->orderBy('value', 'asc')
            ->get();

        if ($settings->isEmpty()) {
            return redirect()
                ->back()
                ->with('error', 'Belum ada periode penilaian yang aktif.');
        }

        $validated = $request->validate([
            'pilihan_berakhlak' => [
                'required',
                'array',
            ],
            'pilihan_pegawai' => [
                'required',
                'array',
            ],
        ]);

        $data = [
            'timestamp' => now(),
            'periode' => $settings->first()->periode,
            'value' => $settings->first()->value,
            'pilihan_berakhlak' => $validated['pilihan_berakhlak'],
            'pilihan_pegawai' => $validated['pilihan_pegawai'],
        ];

        $penilaian->update($data);

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Data penilaian berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    | Menghapus data penilaian.
    */
    public function destroy($id)
    {
        $penilaian = Penilaian::find($id);

        if (!$penilaian) {
            return redirect()
                ->route('penilaian.index')
                ->with('error', 'Data penilaian tidak ditemukan.');
        }

        $penilaian->delete();

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Data penilaian berhasil dihapus.');
    }
}