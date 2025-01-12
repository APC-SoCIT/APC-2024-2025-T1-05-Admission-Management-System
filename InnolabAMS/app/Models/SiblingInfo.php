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
        'sibling_surname',
        'sibling_given_name',
        'sibling_age',
        'sibling_school_name',
        'sibling_school_address',
        'sibling_grade_level'
    ];

    // Relationship with FamilyInfo
    public function familyInfo()
    {
        return $this->belongsTo(FamilyInfo::class, 'family_info_id');
    }
}