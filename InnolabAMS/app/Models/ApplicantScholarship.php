<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantScholarship extends Model
{
    use HasFactory;
    protected $table = 'applicant_scholarship'; 

    protected $fillable = [
        'applicant_info_id',
        'current_scholarship',
        'annual_household_income',
        'applicant_signature',
        'parent_signature',
        'scholarship_document',
    ];

    /**
     * Define the relationship with the ApplicantInfo model.
     */

}
