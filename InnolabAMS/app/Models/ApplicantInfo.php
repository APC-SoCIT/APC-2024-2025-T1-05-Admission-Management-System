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
        'status',  // Add status to fillable
        'apply_program',
        'apply_grade_level',
        'apply_strand',
        'applicant_surname',
        'applicant_given_name',
        'applicant_middle_name',
        'applicant_extension',
        'applicant_date_birth',
        'applicant_place_birth',
        'gender',
        'applicant_address_street',
        'applicant_address_province',
        'applicant_address_city',
        'applicant_nationality',
        'applicant_religion',
        'applicant_mobile_number',
        'applicant_photo',
        'extracurricular_interest',
        'skills',
        'hobbies',
        'participations',
        'competitions',
        'referral_source',
    ];

    protected $casts = [
        'applicant_date_birth' => 'date',
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