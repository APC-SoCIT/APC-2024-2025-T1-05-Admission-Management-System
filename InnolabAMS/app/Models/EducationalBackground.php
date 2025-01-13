<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalBackground extends Model
{
    use HasFactory;

    protected $table = 'educational_background';

    protected $fillable = [
        'applicant_id',
        'lrn',
        'sped',
        'pwd',
        'applicant_school_name',
        'applicant_school_address',
        'applicant_last_grade_level',
        'applicant_year_graduation',
        'applicant_gwa',
        'applicant_achievements'
    ];

    protected $casts = [
        'sped' => 'boolean',
        'pwd' => 'boolean',
        'applicant_year_graduation' => 'date',
        'applicant_gwa' => 'decimal:2'
    ];

    /**
     * Get the applicant that owns the educational background.
     */
    public function applicant()
    {
        return $this->belongsTo(ApplicantInfo::class, 'applicant_id');
    }
}