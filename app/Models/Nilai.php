<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Nilai extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'nilais';

    protected $fillable = [
        'value',
        'implementasi',
        'skor',
    ];

    protected $casts = [
        'skor' => 'integer',
    ];
}