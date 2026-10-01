<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Penilaian;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    | Route daftar penilaian tergantung role pengguna.
    */
    private function indexRoute(): string
    {
        return auth()->user()->role === 'admin'
            ? 'penilaian.index'
            : 'user.penilaian';
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | Menampilkan daftar periode penilaian.
    */
    public function index()
    {
        $riwayatSettings = Setting::orderBy('periode', 'desc')
            ->orderBy('value', 'asc')
            ->get();

        return view('penilaian.index', compact('riwayatSettings'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    | Menampilkan form penilaian untuk periode yang dipilih.
    */
    public function form($id)
    {
        $settingAktif = Setting::findOrFail($id);

        if ($settingAktif->status !== 'aktif') {
            return redirect()
                ->route($this->indexRoute())
                ->with('error', 'Periode penilaian ini sudah tidak aktif.');
        }

        $implementasi = Nilai::where('value', $settingAktif->value)
            ->orderBy('id', 'asc')
            ->get();

        $pegawai = User::where('role', 'user')
            ->orderBy('name', 'asc')
            ->get();

        return view('penilaian.page.penilaian', [
            'settingAktif' => $settingAktif,
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
    | Menyimpan penilaian baru berdasarkan periode & core value dari form.
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode'           => ['required', 'string'],
            'value'             => ['required', 'string'],
            'pilihan_berakhlak' => ['required', 'array'],
            'pilihan_pegawai'   => ['required', 'array'],
        ]);

        $setting = Setting::where('status', 'aktif')
            ->where('periode', $validated['periode'])
            ->where('value', $validated['value'])
            ->first();

        if (!$setting) {
            return redirect()
                ->route($this->indexRoute())
                ->with('error', 'Periode penilaian ini tidak aktif.');
        }

        Penilaian::create([
            'timestamp'         => now(),
            'periode'           => $setting->periode,
            'value'             => $setting->value,
            'pilihan_berakhlak' => $validated['pilihan_berakhlak'],
            'pilihan_pegawai'   => $validated['pilihan_pegawai'],
        ]);

        return redirect()
            ->route($this->indexRoute())
            ->with('success', 'Data penilaian berhasil disimpan.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $penilaian = Penilaian::find($id);

        if (!$penilaian) {
            return redirect()
                ->route($this->indexRoute())
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
            'pilihan_berakhlak' => ['required', 'array'],
            'pilihan_pegawai'   => ['required', 'array'],
        ]);

        $penilaian->update([
            'timestamp'         => now(),
            'periode'           => $settings->first()->periode,
            'value'             => $settings->first()->value,
            'pilihan_berakhlak' => $validated['pilihan_berakhlak'],
            'pilihan_pegawai'   => $validated['pilihan_pegawai'],
        ]);

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Data penilaian berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
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