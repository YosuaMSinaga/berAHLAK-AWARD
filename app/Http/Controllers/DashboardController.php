<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Olah;
use App\Models\Setting;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard utama
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // ADMIN
        if ($user->role === 'admin') {
            return view('dashboard.admin', [
                'totalPenilaian' => Penilaian::count(),
                'selesai' => Penilaian::where('status', 'selesai')->count(),
                'draft' => Penilaian::where('status', 'draft')->count(),
            ]);
        }

        // VIEWER
        if ($user->role === 'viewer') {
            return view('dashboard.viewer', [
                'totalPenilaian' => Penilaian::count(),
            ]);
        }

        // USER
        return view('dashboard.user', [
            'totalPenilaian' => Penilaian::count(),
        ]);
    }


    /**
     * Dashboard berdasarkan periode
     */
    public function periode($periode = null)
    {
        if (!$periode) {
            return redirect()->route('dashboard');
        }

        session([
            'dashboard_periode' => $periode,
        ]);

        return redirect()->route('dashboard');
    }


    /**
     * Mengambil daftar periode yang tersedia
     */
    public function getPeriode()
    {
        try {

            $periode = Setting::query()
                ->whereNotNull('periode')
                ->where('periode', '!=', '')
                ->get(['periode'])
                ->pluck('periode')
                ->filter(function ($value) {
                    return $value !== null
                        && trim((string) $value) !== '';
                })
                ->map(function ($value) {
                    return trim((string) $value);
                })
                ->unique()
                ->values();

            return response()->json([
                'success' => true,
                'periode' => $periode,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil daftar periode.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Mengambil seluruh data dashboard berdasarkan periode
     */
    public function getDataByPeriode(Request $request)
    {
        try {

            $periode = $request->query('periode');

            if (!$periode) {
                return response()->json([
                    'success' => false,
                    'message' => 'Periode belum dipilih.',
                ], 400);
            }

            // DATA OLAH
            $dataOlah = Olah::query()
                ->where('periode', $periode)
                ->get();

            // FUNGSI CEK STATUS
            $statusSudahMengisi = function ($status) {

                $status = strtolower(
                    trim((string) $status)
                );

                return in_array($status, [
                    'sudah',
                    'sudah mengisi',
                    'sudah_isi',
                    'terisi',
                    'isi',
                    '1',
                    'true',
                    'ya',
                ], true);
            };

            // HITUNG SUDAH DAN BELUM MENGISI
            $sudahMengisi = $dataOlah->filter(
                function ($item) use ($statusSudahMengisi) {
                    return $statusSudahMengisi($item->status_isi ?? '');
                }
            );

            $belumMengisi = $dataOlah->filter(
                function ($item) use ($statusSudahMengisi) {
                    return !$statusSudahMengisi($item->status_isi ?? '');
                }
            );

            $jumlahSudah = $sudahMengisi->count();
            $jumlahBelum = $belumMengisi->count();
            $totalPegawai = $dataOlah->count();

            // PERSENTASE PENGISIAN
            $persentase = $totalPegawai > 0
                ? round(($jumlahSudah / $totalPegawai) * 100, 2)
                : 0;

            // DATA SETTING
            $setting = Setting::query()
                ->where('periode', $periode)
                ->first();

            $coreValueAktif = '-';
            $avgBerakhlak = 0;
            $avgPeer = 0;
            $avgAkhir = 0;
            $korelasi = 0;

            if ($setting) {
                $coreValueAktif = $setting->value ?? '-';
                $avgBerakhlak = (float) ($setting->avgberakhlak ?? 0);
                $avgPeer = (float) ($setting->avgpeer ?? 0);
                $avgAkhir = (float) ($setting->avgakhir ?? 0);
                $korelasi = (float) ($setting->korelasi ?? 0);
            }

            // DATA PEGAWAI
            $pegawai = $dataOlah->map(
                function ($item) use ($statusSudahMengisi) {

                    $nama = '-';

                    try {
                        $user = \App\Models\User::where('nip', $item->nip)->first();

                        if ($user) {
                            $nama = $user->name ?? '-';
                        }
                    } catch (\Throwable $e) {
                        $nama = '-';
                    }

                    $sudah = $statusSudahMengisi($item->status_isi ?? '');

                    return [
                        'nip' => $item->nip ?? '-',
                        'nama' => $nama,
                        'status_isi' => $sudah ? 'Sudah Mengisi' : 'Belum Mengisi',
                    ];
                }
            )->values();

            // DATA CHART IMPLEMENTASI BERAKHLAK
            $chartValue = Value::query()
                ->where('periode', $periode)
                ->get(['implementasi', 'persentase'])
                ->map(function ($item) {
                    return [
                        'implementasi' => $item->implementasi ?? '-',
                        'persentase' => round((float) ($item->persentase ?? 0), 2),
                    ];
                })
                ->values();

            return response()->json([
                'success' => true,
                'periode' => $periode,

                // Progres pengisian
                'sudah_mengisi' => $jumlahSudah,
                'belum_mengisi' => $jumlahBelum,
                'total_pegawai' => $totalPegawai,
                'persentase' => $persentase,

                // Core value
                'core_value_aktif' => $coreValueAktif,

                // Rekap nilai
                'avg_skor_berakhlak' => round($avgBerakhlak, 2),
                'avg_skor_rekan' => round($avgPeer, 2),
                'avg_skor_akhir' => round($avgAkhir, 2),
                'korelasi_r' => round($korelasi, 4),

                // Data pegawai & chart
                'pegawai' => $pegawai,
                'chart_value' => $chartValue,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data dashboard.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Riwayat penilaian pribadi (per periode) untuk user yang login.
     *
     * skor_berakhlak -> skor_self  (Wawasan BerAKHLAK)
     * skor_rekan_2   -> skor_peer  (Penerapan BerAKHLAK)
     * skor_akhir     -> skor_akhir
     */
    public function getLaporanPribadi()
    {
        try {

            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Belum login.',
                ], 401);
            }

            // NIP di MongoDB bisa tersimpan sebagai string atau angka
            $nip = $user->nip;
            $nipVariants = array_values(array_unique([
                (string) $nip,
                is_numeric($nip) ? (int) $nip : $nip,
            ], SORT_REGULAR));

            $riwayat = Olah::query()
                ->whereIn('nip', $nipVariants)
                ->whereNotNull('skor_akhir')
                ->get()
                ->map(function ($item) {
                    return [
                        'periode'    => (string) $item->periode,
                        'skor_self'  => round((float) ($item->skor_berakhlak ?? 0), 2),
                        'skor_peer'  => round((float) ($item->skor_rekan_2 ?? 0), 2),
                        'skor_akhir' => round((float) ($item->skor_akhir ?? 0), 2),
                    ];
                })
                ->sortBy('periode', SORT_NATURAL)
                ->values();

            return response()->json([
                'success' => true,
                'riwayat' => $riwayat,
                'rerata'  => [
                    'self'  => round($riwayat->avg('skor_self') ?? 0, 2),
                    'peer'  => round($riwayat->avg('skor_peer') ?? 0, 2),
                    'akhir' => round($riwayat->avg('skor_akhir') ?? 0, 2),
                ],
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil laporan pribadi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}