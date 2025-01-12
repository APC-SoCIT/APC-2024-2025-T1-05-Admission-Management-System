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
        'father_surname',
        'father_given_name',
        'father_middle_name',
        'father_occupation',
        'father_contact_num',
        'mother_surname',
        'mother_given_name',
        'mother_middle_name',
        'mother_occupation',
        'mother_contact_num',
        'guardian_info',
        'guardian_surname',
        'guardian_given_name',
        'guardian_middle_name',
        'guardian_address_street',
        'guardian_address_city',
        'guardian_contact_num',
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