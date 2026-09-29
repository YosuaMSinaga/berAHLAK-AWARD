<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemenangController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PEMENANG & SERTIFIKAT
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('dashboard.page.Pemenang');
    }


    /*
    |--------------------------------------------------------------------------
    | 1. PERIODE AKTIF
    |--------------------------------------------------------------------------
    */

    public function periodeAktif()
    {
        $setting = Setting::where('status', 'aktif')
            ->orderBy('periode', 'desc')
            ->first();

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada periode penilaian yang aktif.',
                'periode' => null,
            ]);
        }

        return response()->json([
            'success' => true,

            'periode' => [
                'nama_periode' => $setting->periode,

                'core_value' => $setting->value,

                'kuota' => (int) (
                    $setting->kuota_pemenang ?? 1
                ),
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | 2. RIWAYAT PEMENANG
    |--------------------------------------------------------------------------
    */

    public function riwayat()
    {
        try {

            $pemenang = DB::connection('mongodb')
                ->collection('pemenangs')
                ->orderBy('periode', 'desc')
                ->orderBy('rank', 'asc')
                ->get();


            $data = $pemenang->map(function ($item) {

                return [

                    'periode' => $item['periode'] ?? '-',

                    'core_value' => $item['core_value'] ?? '-',

                    'rank' => $item['rank'] ?? '-',

                    'nip' => $item['nip'] ?? '-',

                    'nama' => $item['nama'] ?? '-',

                    'no_sertifikat' =>
                        $item['no_sertifikat'] ?? '-',

                    'tanggal_penetapan' =>
                        $item['tanggal_penetapan'] ?? null,

                    'lokasi_penetapan' =>
                        $item['lokasi_penetapan']
                        ?? 'Sidikalang',
                ];
            })
            ->values();


            return response()->json([

                'success' => true,

                'pemenang' => $data,

            ]);

        } catch (\Throwable $e) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Gagal mengambil riwayat pemenang.',

                'pemenang' => [],

                'error' => $e->getMessage(),

            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 3. TETAPKAN PEMENANG
    |--------------------------------------------------------------------------
    |
    | Data pemenang diambil dari collection dbolah.
    |
    */

    public function tetapkan(Request $request)
    {
        try {

            /*
            |--------------------------------------------------------------------------
            | AMBIL SETTING AKTIF
            |--------------------------------------------------------------------------
            */

            $setting = Setting::where('status', 'aktif')
                ->orderBy('periode', 'desc')
                ->first();


            if (!$setting) {

                return response()->json([

                    'success' => false,

                    'message' =>
                        'Belum ada pengaturan periode yang aktif.',

                ], 422);
            }


            $periode = $setting->periode;

            $coreValue = $setting->value;

            $kuota = (int) (
                $setting->kuota_pemenang ?? 1
            );


            if ($kuota < 1) {
                $kuota = 1;
            }


            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA DBOLAH
            |--------------------------------------------------------------------------
            */

            $olah = DB::connection('mongodb')
                ->collection('dbolah')
                ->where('periode', $periode)
                ->get();


            if ($olah->isEmpty()) {

                return response()->json([

                    'success' => false,

                    'message' =>
                        'Belum ada data pengolahan (dbolah) untuk periode '
                        . $periode
                        . '.',

                ], 422);
            }


            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA PEGAWAI
            |--------------------------------------------------------------------------
            */

            $pegawai = DB::connection('mongodb')
                ->collection('dbpegawai')
                ->get()
                ->keyBy(function ($item) {

                    return (string) (
                        $item['nip'] ?? ''
                    );
                });


            /*
            |--------------------------------------------------------------------------
            | NORMALISASI DATA DBOLAH
            |--------------------------------------------------------------------------
            */

            $dataPemenang = $olah
                ->map(function ($item) use ($pegawai) {

                    /*
                    |--------------------------------------------------------------------------
                    | NIP
                    |--------------------------------------------------------------------------
                    */

                    $nip = (string) (
                        $item['nip']
                        ?? $item['nip_pengisi']
                        ?? ''
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | NAMA
                    |--------------------------------------------------------------------------
                    */

                    $nama = '-';


                    if (
                        $nip !== ''
                        && isset($pegawai[$nip])
                    ) {

                        $nama =
                            $pegawai[$nip]['nama']
                            ?? $pegawai[$nip]['name']
                            ?? '-';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SKOR AKHIR
                    |--------------------------------------------------------------------------
                    */

                    $skorAkhir = null;


                    /*
                    | Prioritas 1:
                    | skor_akhir
                    */

                    if (
                        isset($item['skor_akhir'])
                    ) {

                        $skorAkhir =
                            (float) $item['skor_akhir'];
                    }


                    /*
                    | Prioritas 2:
                    | skor
                    */

                    elseif (
                        isset($item['skor'])
                    ) {

                        $skorAkhir =
                            (float) $item['skor'];
                    }


                    /*
                    | Prioritas 3:
                    | avgakhir
                    */

                    elseif (
                        isset($item['avgakhir'])
                    ) {

                        $skorAkhir =
                            (float) $item['avgakhir'];
                    }


                    /*
                    | Prioritas 4:
                    | skor_berakhlak + skor_rekan
                    */

                    elseif (
                        isset($item['skor_berakhlak'])
                        &&
                        isset($item['skor_rekan'])
                    ) {

                        $skorAkhir =
                            (
                                (float)
                                $item['skor_berakhlak']

                                +

                                (float)
                                $item['skor_rekan']
                            ) / 2;
                    }


                    return [

                        'nip' => $nip,

                        'nama' => $nama,

                        'skor_akhir' =>
                            $skorAkhir ?? 0,
                    ];
                })


                /*
                |--------------------------------------------------------------------------
                | HANYA DATA YANG MEMILIKI NIP
                |--------------------------------------------------------------------------
                */

                ->filter(function ($item) {

                    return $item['nip'] !== '';
                })


                /*
                |--------------------------------------------------------------------------
                | URUTKAN SKOR TERTINGGI
                |--------------------------------------------------------------------------
                */

                ->sortByDesc('skor_akhir')


                ->values();


            /*
            |--------------------------------------------------------------------------
            | AMBIL SESUAI KUOTA
            |--------------------------------------------------------------------------
            */

            $pemenangTerpilih = $dataPemenang
                ->take($kuota)
                ->values();


            if (
                $pemenangTerpilih->isEmpty()
            ) {

                return response()->json([

                    'success' => false,

                    'message' =>
                        'Tidak ditemukan kandidat pemenang.',

                ], 422);
            }


            /*
            |--------------------------------------------------------------------------
            | HAPUS DATA PEMENANG LAMA
            |--------------------------------------------------------------------------
            |
            | Jika tombol ditekan kembali pada periode dan
            | core value yang sama, data lama diganti.
            |
            */

            DB::connection('mongodb')
                ->collection('pemenangs')
                ->where('periode', $periode)
                ->where('core_value', $coreValue)
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | NOMOR SERTIFIKAT
            |--------------------------------------------------------------------------
            */

            $jumlahLama = DB::connection('mongodb')
                ->collection('pemenangs')
                ->count();


            $nomorAwal = $jumlahLama + 1;


            /*
            |--------------------------------------------------------------------------
            | SIMPAN PEMENANG
            |--------------------------------------------------------------------------
            */

            foreach (
                $pemenangTerpilih as
                $index => $item
            ) {

                $rank = $index + 1;


                /*
                | Nomor urut sertifikat
                */

                $nomor = str_pad(

                    $nomorAwal + $index,

                    3,

                    '0',

                    STR_PAD_LEFT
                );


                /*
                | Nomor sertifikat otomatis
                */

                $nomorSertifikat =
                    $nomor
                    . '/BA-BPS/DAIRI/'
                    . date('Y');


                /*
                | Simpan
                */

                DB::connection('mongodb')
                    ->collection('pemenangs')
                    ->insert([

                        'periode' =>
                            $periode,

                        'core_value' =>
                            $coreValue,

                        'rank' =>
                            $rank,

                        'nip' =>
                            $item['nip'],

                        'nama' =>
                            $item['nama'],

                        'skor_akhir' =>
                            $item['skor_akhir'],

                        'no_sertifikat' =>
                            $nomorSertifikat,

                        'tanggal_penetapan' =>
                            now()->toDateTimeString(),

                        'lokasi_penetapan' =>
                            'Sidikalang',

                        'created_at' =>
                            now(),

                        'updated_at' =>
                            now(),
                    ]);
            }


            /*
            |--------------------------------------------------------------------------
            | RESPONSE BERHASIL
            |--------------------------------------------------------------------------
            */

            return response()->json([

                'success' => true,

                'message' =>
                    'Pemenang periode '
                    . $periode
                    . ' berhasil ditetapkan dan direkam.',

            ]);

        } catch (\Throwable $e) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Gagal menetapkan pemenang.',

                'error' =>
                    $e->getMessage(),

            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 4. UPDATE NOMOR SERTIFIKAT
    |--------------------------------------------------------------------------
    */

    public function updateNoSertifikat(
        Request $request
    ) {

        try {

            /*
            |--------------------------------------------------------------------------
            | VALIDASI
            |--------------------------------------------------------------------------
            */

            $validated = $request->validate([

                'periode' => [
                    'required',
                    'string',
                ],

                'nip' => [
                    'required',
                    'string',
                ],

                'no_sertifikat' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

            ]);


            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

            $updated = DB::connection('mongodb')
                ->collection('pemenangs')

                ->where(
                    'periode',
                    $validated['periode']
                )

                ->where(
                    'nip',
                    $validated['nip']
                )

                ->update([

                    'no_sertifikat' =>
                        $validated['no_sertifikat']
                        ?: '-',

                    'updated_at' =>
                        now(),

                ]);


            /*
            |--------------------------------------------------------------------------
            | DATA TIDAK DITEMUKAN
            |--------------------------------------------------------------------------
            */

            if (!$updated) {

                return response()->json([

                    'success' => false,

                    'message' =>
                        'Data pemenang tidak ditemukan.',

                ], 404);
            }


            /*
            |--------------------------------------------------------------------------
            | BERHASIL
            |--------------------------------------------------------------------------
            */

            return response()->json([

                'success' => true,

                'message' =>
                    'Nomor sertifikat berhasil diperbarui.',

            ]);

        } catch (\Throwable $e) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Gagal memperbarui nomor sertifikat.',

                'error' =>
                    $e->getMessage(),

            ], 500);
        }
    }
}