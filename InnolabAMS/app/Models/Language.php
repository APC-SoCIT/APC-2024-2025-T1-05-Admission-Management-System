<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];
}
