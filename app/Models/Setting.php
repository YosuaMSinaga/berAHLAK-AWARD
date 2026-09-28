<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Setting extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'settings';

    protected $fillable = [
        'periode',
        'jum_pilihan',
        'max_pilihan',
        'status',
        'avgberakhlak',
        'avgpeer',
        'avgakhir',
        'korelasi',
    ];

    protected $casts = [
        'jum_pilihan' => 'integer',
        'max_pilihan' => 'integer',
        'avgberakhlak' => 'float',
        'avgpeer' => 'float',
        'avgakhir' => 'float',
        'korelasi' => 'float',
    ];
}