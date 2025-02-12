<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyInfo extends Model
{
    use HasFactory;

    protected $table = 'family_info';

    protected $fillable = [
        'applicant_info_id',
        'father_name',
        'father_contact',
        'mother_name',
        'mother_contact',
        'guardian_name',
        'guardian_contact'
    ];

    // Relationship with ApplicantInfo
    public function applicant()
    {
        return $this->belongsTo(ApplicantInfo::class, 'applicant_info_id');
    }

    // Relationship with siblings
    public function siblings()
    {
        return $this->hasMany(SiblingInfo::class);
    }
}