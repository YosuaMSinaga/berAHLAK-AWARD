<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function edit()
    {
        return view('dashboard.userpage.profil');
    }

    /**
     * Memperbarui data profil pengguna (Nama, Email, NIP, Jabatan, dan Foto Base64).
     */
    public function update(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            abort(401);
        }

        // Validasi input form CRUD profil termasuk input foto base64
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:100',
            'foto' => 'nullable|string', // Menerima data string Base64 dari input tersembunyi
        ]);

        // Proses penyimpanan perubahan data dasar ke database
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nip = $request->nip;
        $user->jabatan = $request->jabatan;

        // Jika ada string base64 foto baru yang dikirimkan, perbarui properti foto
        if ($request->filled('foto')) {
            $user->foto = $request->foto;
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil pengguna berhasil diperbarui!');
    }
}