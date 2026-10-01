<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Setting extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'settings';

    protected $fillable = [
        'periode',
        'value',
        'jum_pilihan',
        'max_pilihan',
        'pemenang',
        'status',
        'avgberakhlak',
        'avgpeer',
        'avgakhir',
        'korelasi',
    
    ];

    protected $casts = [
        'jum_pilihan' => 'integer',
        'max_pilihan' => 'integer',
        'pemenang' => 'array',

        'avgberakhlak' => 'float',
        'avgpeer' => 'float',
        'avgakhir' => 'float',
        'korelasi' => 'float',
    ];
}