<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaian = Penilaian::latest()->get();

        return view('penilaian.index', compact('penilaian'));
    }

    public function create()
    {
        return view('penilaian.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nilai' => 'required|integer|min:0|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:draft,selesai',
        ]);

        $data['dinilai_oleh'] = auth()->user()->name;

        Penilaian::create($data);

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Data penilaian berhasil ditambahkan.');
    }

    public function edit(Penilaian $penilaian)
    {
        return view('penilaian.form', compact('penilaian'));
    }

    public function update(
        Request $request,
        Penilaian $penilaian
    ) {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nilai' => 'required|integer|min:0|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:draft,selesai',
        ]);

        $penilaian->update($data);

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Data penilaian berhasil diperbarui.');
    }

    public function destroy(Penilaian $penilaian)
    {
        $penilaian->delete();

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}