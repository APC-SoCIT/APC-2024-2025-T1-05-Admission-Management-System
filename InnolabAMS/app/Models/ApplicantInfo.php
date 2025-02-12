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
        'student_type',
        'previous_school',
        'transfer_reason',
        'gap_period',
        'return_reason',
        'current_grade_level',
        'academic_status',
        'applicant_surname',
        'applicant_given_name',
        'applicant_middle_name',
        'applicant_extension',
        'applicant_date_birth',
        'age',
        'gender',
        'applicant_tel_no',
        'applicant_mobile_number',
        'applicant_nationality',
        'applicant_religion',
        'applicant_address_street',
        'applicant_address_city',
        'applicant_address_province',
        'birth_certificate_path',
        'photo_path',
        'form_137_path',
        'form_138_path',
        'good_moral_path',
        'guardian_id_path',
        'medical_records_path'
    ];

    protected $casts = [
        'applicant_date_birth' => 'date',
        'age' => 'integer',
    ];

    // Status constants
    const STATUS_NEW = 'new';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    // Student type constants
    const TYPE_TRANSFEREE = 'transferee_new';
    const TYPE_EXISTING = 'existing';
    const TYPE_RETURNING = 'returning';

    // Validation rules
    const VALIDATION_RULES = [
        // Program Information
        'student_type' => 'required|in:transferee_new,existing,returning',
        'previous_school' => 'required_if:student_type,transferee_new|nullable|regex:/^[\pL\s\-\.]+$/u',
        'transfer_reason' => 'required_if:student_type,transferee_new|nullable',
        'gap_period' => 'required_if:student_type,returning|nullable|numeric',
        'return_reason' => 'required_if:student_type,returning|nullable',
        'current_grade_level' => 'required_if:student_type,existing|nullable',
        'academic_status' => 'required_if:student_type,existing|nullable|in:regular,irregular,probation',

        // Personal Information
        'applicant_given_name' => 'required|regex:/^[\pL\s\-]+$/u',
        'applicant_surname' => 'required|regex:/^[\pL\s\-]+$/u',
        'applicant_middle_name' => 'nullable|regex:/^[\pL\s\-]+$/u',
        'applicant_extension' => 'nullable|regex:/^[\pL\s\-\.]+$/u',
        'gender' => 'required|in:Male,Female',
        'applicant_date_birth' => 'required|date|before:today',
        'age' => 'required|numeric|min:4|max:25',
        'applicant_nationality' => 'required|regex:/^[\pL\s\-]+$/u',
        'applicant_religion' => 'required|regex:/^[\pL\s\-]+$/u',
        'applicant_mobile_number' => ['required', 'regex:/^09\d{2}-\d{3}-\d{4}$/'],
        'applicant_tel_no' => ['nullable', 'regex:/^\(02\) \d{4}-\d{4}$/'],

        // Contact Information
        'applicant_address_street' => 'required|string|max:255',
        'applicant_address_city' => 'required|string|max:255',
        'applicant_address_province' => 'required|string|max:255',

        // Educational Background
        'lrn' => 'nullable|string|max:12',
        'school_name' => 'nullable|string|max:255',
        'school_address' => 'nullable|string|max:255',
        'previous_program' => 'nullable|string|max:255',
        'year_of_graduation' => 'nullable|string|max:4',
        'awards_honors' => 'nullable|string',
        'gwa' => 'nullable|numeric|between:1.00,5.00',

        // Document Uploads
        'birth_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        'photo' => 'required|file|mimes:jpg,jpeg,png|max:10240',
        'form_137' => 'required_if:student_type,transferee_new|nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        'form_138' => 'required_if:student_type,transferee_new,existing|nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        'good_moral' => 'required_if:student_type,transferee_new,existing|nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        'guardian_id' => 'required_if:student_type,existing|nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        'medical_records' => 'required_if:student_type,returning|nullable|file|mimes:pdf,jpg,jpeg,png|max:10240'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyInfo()
    {
        return $this->hasOne(FamilyInfo::class, 'applicant_info_id');
    }

    public function siblings()
    {
        return $this->hasMany(SiblingInfo::class, 'applicant_info_id');
    }

    public function educationalBackground()
    {
        return $this->hasOne(EducationalBackground::class, 'applicant_info_id');
    }

    // Scopes
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Accessors
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