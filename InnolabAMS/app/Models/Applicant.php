<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'gender',
        'apply_program',
        'applicant_mobile_number',
        'parent_name',
        'city',
        'grade',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('full_name', 'like', '%' . $term . '%')
                ->orWhere('id', 'like', '%' . $term . '%')
                ->orWhere('parent_name', 'like', '%' . $term . '%')
                ->orWhere('city', 'like', '%' . $term . '%')
                ->orWhere('grade', 'like', '%' . $term . '%');
        });
    }
}
