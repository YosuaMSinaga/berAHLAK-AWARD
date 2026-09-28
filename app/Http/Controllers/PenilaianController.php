<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Penilaian;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $periode = Setting::where('status', 'aktif')
            ->orderBy('periode', 'desc')
            ->first()?->periode;

        if (!$periode) {
            return view('penilaian.index', [
                'penilaian' => collect(),
                'periode' => null,
            ]);
        }

        $penilaian = Penilaian::where('periode', $periode)
            ->where('nip_pengisi', Auth::user()->id)
            ->latest()
            ->get();

        return view('penilaian.index', compact(
            'penilaian',
            'periode'
        ));
    }

    public function create()
    {
        $settings = Setting::where('status', 'aktif')
            ->orderBy('value')
            ->get();

        if ($settings->isEmpty()) {
            return back()->with('error', 'Belum ada periode penilaian yang aktif.');
        }

        $periode = $settings->first()->periode;

        $nilai = Nilai::orderBy('id')->get();

        $nilaiGrouped = $nilai->groupBy('value');

        return view('penilaian.form', [
            'settings' => $settings,
            'nilaiGrouped' => $nilaiGrouped,
            'periode' => $periode,
        ]);
    }

    public function store(Request $request)
    {
        $settings = Setting::where('status', 'aktif')
            ->orderBy('value')
            ->get();

        if ($settings->isEmpty()) {
            return back()->with('error', 'Belum ada periode penilaian yang aktif.');
        }

        $periode = $settings->first()->periode;

        $rules = [];

        foreach ($settings as $setting) {
            $rules["pilihan_{$setting->value}"] = [
                'required',
                'array',
                'size:' . $setting->jum_pilihan,
            ];

            $rules["pilihan_{$setting->value}.*"] = [
                'required',
                'integer',
            ];
        }

        $validated = $request->validate($rules);

        $pilihanBerakhlak = [];

        foreach ($settings as $setting) {
            $key = "pilihan_{$setting->value}";

            foreach ($validated[$key] as $nilaiId) {
                $nilai = Nilai::where('id', (int) $nilaiId)
                    ->where('value', $setting->value)
                    ->first();

                if (!$nilai) {
                    return back()
                        ->withErrors([
                            $key => "Pilihan {$setting->value} tidak valid.",
                        ])
                        ->withInput();
                }

                $pilihanBerakhlak[] = (int) $nilai->id;
            }
        }

        Penilaian::create([
            'timestamp' => now(),
            'periode' => $periode,
            'nip_pengisi' => Auth::user()->id,
            'pilihan_berakhlak' => $pilihanBerakhlak,
            'pilihan_pegawai' => [],
        ]);

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Penilaian berhasil disimpan.');
    }

    public function show(Penilaian $penilaian)
    {
        return view('penilaian.show', compact('penilaian'));
    }

    public function edit(Penilaian $penilaian)
    {
        $settings = Setting::where('status', 'aktif')
            ->orderBy('value')
            ->get();

        $nilai = Nilai::orderBy('id')->get();

        $nilaiGrouped = $nilai->groupBy('value');

        return view('penilaian.form', [
            'penilaian' => $penilaian,
            'settings' => $settings,
            'nilaiGrouped' => $nilaiGrouped,
            'periode' => $penilaian->periode,
        ]);
    }

    public function update(Request $request, Penilaian $penilaian)
    {
        $settings = Setting::where('status', 'aktif')
            ->orderBy('value')
            ->get();

        $rules = [];

        foreach ($settings as $setting) {
            $rules["pilihan_{$setting->value}"] = [
                'required',
                'array',
                'size:' . $setting->jum_pilihan,
            ];

            $rules["pilihan_{$setting->value}.*"] = [
                'required',
                'integer',
            ];
        }

        $validated = $request->validate($rules);

        $pilihanBerakhlak = [];

        foreach ($settings as $setting) {
            $key = "pilihan_{$setting->value}";

            foreach ($validated[$key] as $nilaiId) {
                $nilai = Nilai::where('id', (int) $nilaiId)
                    ->where('value', $setting->value)
                    ->first();

                if (!$nilai) {
                    return back()
                        ->withErrors([
                            $key => "Pilihan {$setting->value} tidak valid.",
                        ])
                        ->withInput();
                }

                $pilihanBerakhlak[] = (int) $nilai->id;
            }
        }

        $penilaian->update([
            'timestamp' => now(),
            'pilihan_berakhlak' => $pilihanBerakhlak,
        ]);

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy(Penilaian $penilaian)
    {
        $penilaian->delete();

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Penilaian berhasil dihapus.');
    }
}