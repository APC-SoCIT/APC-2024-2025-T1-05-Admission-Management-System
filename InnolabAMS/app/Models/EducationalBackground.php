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
        'school_name',
        'school_address',
        'previous_program',
        'year_of_graduation',
        'gwa',
        'awards_honors'
    ];

    protected $casts = [
        'year_of_graduation' => 'integer',
        'gwa' => 'decimal:2'
    ];

    /**
     * Get the applicant that owns the educational background.
     */
    public function applicant()
    {
        return $this->belongsTo(ApplicantInfo::class, 'applicant_id');
    }
}