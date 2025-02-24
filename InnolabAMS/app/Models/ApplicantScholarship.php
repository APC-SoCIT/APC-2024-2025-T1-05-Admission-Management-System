<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantScholarship extends Model
{
    use HasFactory;

    protected $table = 'applicant_scholarships';
    const CREATED_AT = null; // Disable created_at since we don't have this column
    const UPDATED_AT = 'updated_at'; // Specify the updated_at column name

    protected $fillable = [
        'applicant_info_id',
        'current_scholarship',
        'annual_household_income',
        'applicant_signature',
        'parent_signature',
        'scholarship_type',
        'discount_awarded',
        'status'
    ];

    // Set default values
    protected $attributes = [
        'scholarship_type' => 'Financial Assistance',
        'discount_awarded' => 0,
        'status' => 'pending'
    ];

    /**
     * Get the user that owns the applicant information.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applicant_info()
    {
        return $this->belongsTo(ApplicantInfo::class);
    }
}
