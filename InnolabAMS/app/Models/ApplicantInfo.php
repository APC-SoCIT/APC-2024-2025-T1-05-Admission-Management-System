<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantInfo extends Model
{
    use HasFactory;

    protected $table = 'applicant_infos';

    protected $fillable = [
    'user_id',
    'status',
    'apply_program',
    'apply_grade_level',
    'apply_strand',
    'applicant_surname',
    'applicant_given_name',
    'applicant_middle_name',
    'applicant_extension',
    'applicant_date_birth',
    'age',
    'applicant_place_birth',
    'gender',
    'applicant_tel_no',
    'applicant_address_street',
    'applicant_address_province',
    'applicant_barangay',
    'applicant_address_city',
    'applicant_nationality',
    'applicant_religion',
    'applicant_mobile_number',
    'applicant_email',
    'applicant_photo',
    'lrn',
    'school_name',
    'school_address',
    'previous_program',
    'year_of_graduation',
    'awards_honors',
    'gwa',
    'student_type',
    'father_given_name',
    'father_middle_name',
    'father_surname',
    'father_contact',
    'mother_given_name',
    'mother_middle_name',
    'mother_surname',
    'mother_contact',
    'guardian_given_name',
    'guardian_middle_name',
    'guardian_surname',
    'guardian_contact_num',
    'guardian_occupation',
    'siblings',
    'emergency_contact_name',
    'emergency_contact_address',
    'emergency_contact_tel',
    'emergency_contact_mobile',
    'emergency_contact_email',
    'extracurricular_interest',
    'skills',
    'hobbies',
    'participations',
    'competitions',
    'referral_source',
    'birth_certificate_path',
    'form_137_path',
    'form_138_path',
    'id_picture_path',
    'good_moral_path',
    'rejection_reason',
    'is_only_child',
    'acceptance_message',
    'accepted_at'
    ];

    protected $casts = [
        'applicant_date_birth' => 'date',
        'is_only_child' => 'boolean',
    ];

    protected $dates = [
        'accepted_at'
    ];

    protected $appends = [
        'applicant_email', 
    ];

    // Define status constants for better code readability
    const STATUS_NEW = 'new';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    /**
     * Get the user that owns the applicant information.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include applications with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get the full name of the applicant.
     */
    public function getFullNameAttribute()
    {
        $parts = [
            $this->applicant_surname,
            $this->applicant_given_name,
            $this->applicant_middle_name,
            $this->applicant_extension
        ];

        return implode(' ', array_filter($parts));
    }
}
