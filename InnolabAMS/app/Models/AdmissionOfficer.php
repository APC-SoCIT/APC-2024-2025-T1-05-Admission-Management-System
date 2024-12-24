<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmissionOfficer extends Model
{
    use HasFactory;

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
