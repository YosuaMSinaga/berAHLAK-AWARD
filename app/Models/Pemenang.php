<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Pemenang extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'pemenangs';

    protected $fillable = [
        'periode',
        'value',
        'nip',
        'nama',
        'rank',
        'nosertifikat',
    ];

    protected $casts = [
        'rank' => 'integer',
    ];
}