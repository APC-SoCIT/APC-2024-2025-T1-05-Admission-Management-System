<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyInfo extends Model
{
    use HasFactory;

    protected $table = 'family_info';

    protected $fillable = [
        'applicant_id',
        // Father's Information
        'father_name',
        'father_occupation',
        'father_contact_num',
        // Mother's Information
        'mother_name',
        'mother_occupation',
        'mother_contact_num',
        // Guardian's Information
        'guardian_name',
        'guardian_street_number',
        'guardian_barangay',
        'guardian_city',
        'guardian_telephone',
        'guardian_mobile',
        'guardian_email'
    ];

    // Relationship with ApplicantInfo
    public function applicant()
    {
        return $this->belongsTo(ApplicantInfo::class, 'applicant_id');
    }

    // Relationship with siblings
    public function siblings()
    {
        return $this->hasMany(SiblingInfo::class);
    }
}