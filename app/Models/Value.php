<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Value extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'values';

    protected $fillable = [
        'periode',
        'implementasi',
        'persentase',
    ];

    protected $casts = [
        'persentase' => 'float',
    ];
}