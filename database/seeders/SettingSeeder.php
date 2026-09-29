<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data setting lama
        Setting::truncate();

        // Data contoh awal hanya SATU setting
        Setting::create([
            'periode' => '2026 09',
            'value' => 'Adaptif',
            'jum_pilihan' => 3,
            'max_pilihan' => 15,
            'kuota_pemenang' => 1,
            'status' => 'aktif',

            'avgberakhlak' => 0,
            'avgpeer' => 0,
            'avgakhir' => 0,
            'korelasi' => 0,
        ]);
    }
}