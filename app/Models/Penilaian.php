<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Penilaian extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'penilaians';

    protected $fillable = [
        'timestamp',
        'periode',
        'nip_pengisi',
        'pilihan_berakhlak',
        'pilihan_pegawai',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'pilihan_berakhlak' => 'array',
        'pilihan_pegawai' => 'array',
    ];
}

