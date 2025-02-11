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
        'father_contact_number',
        // Mother's Information
        'mother_name',
        'mother_occupation',
        'mother_contact_number',
        // Emergency Contact
        'emergency_contact_name',
        'emergency_contact_address',
        'emergency_contact_tel',
        'emergency_contact_mobile',
        'emergency_contact_email'
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