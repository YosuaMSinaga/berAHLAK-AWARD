<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $periode = '2026 09';

        $values = [
            'Berorientasi Pelayanan',
            'Akuntabel',
            'Kompeten',
            'Harmonis',
            'Loyal',
            'Adaptif',
            'Kolaboratif',
        ];

        Setting::truncate();

        foreach ($values as $value) {
            Setting::create([
                'periode' => $periode,
                'value' => $value,
                'jum_pilihan' => 3,
                'max_pilihan' => 15,
                'status' => 'aktif',
                'avgberakhlak' => 0,
                'avgpeer' => 0,
                'avgakhir' => 0,
                'korelasi' => 0,
            ]);
        }
    }
}