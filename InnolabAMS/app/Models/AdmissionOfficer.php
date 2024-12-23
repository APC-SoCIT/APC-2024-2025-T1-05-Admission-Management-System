<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdmissionOfficer extends Model
{
    protected $fillable = [
        'user_id',
        'department',
        'position'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
