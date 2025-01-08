<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantScholarship extends Model
{
    use HasFactory;
    protected $table = 'applicant_scholarships';


    protected $fillable = [
        'applicant_info_id',
        'current_scholarship',
        'annual_household_income',
        'applicant_signature',
        'parent_signature',
        'scholarship_type',
        'discount_awarded',
    ];

    /**
     * Get the user that owns the applicant information.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
