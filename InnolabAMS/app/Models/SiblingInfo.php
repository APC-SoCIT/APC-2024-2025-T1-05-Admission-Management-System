<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiblingInfo extends Model
{
    use HasFactory;

    protected $table = 'siblings_info';

    protected $fillable = [
        'family_info_id',
        'full_name',
        'date_of_birth',
        'age',
        'grade_level',
        'school_attended'
    ];

    protected $casts = [
        'date_of_birth' => 'date'
    ];

    // Relationship with FamilyInfo
    public function familyInfo()
    {
        return $this->belongsTo(FamilyInfo::class, 'family_info_id');
    }
}