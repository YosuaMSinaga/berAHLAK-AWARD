<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Olah extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'olahs';

    protected $fillable = [
        'periode',
        'nip',
        'skor_berakhlak',
        'skor_rekan',
        'status_isi',
        'skor_akhir',
        'skor_rekan_2',
    ];

    protected $casts = [
        'skor_berakhlak' => 'float',
        'skor_rekan' => 'float',
        'skor_akhir' => 'float',
        'skor_rekan_2' => 'float',
    ];
}