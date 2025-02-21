<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadInfo extends Model
{
    use HasFactory;

    protected $table = 'lead_info'; // Table associated with this model

    protected $fillable = [
        'lead_surname',
        'lead_given_name',
        'lead_middle_name',
        'lead_extension',
        'lead_address_city',
        'lead_mobile_number',
        'lead_email',
        'inquired_details',
        'lead_message',
        'extracurricular_interest_lead',
        'skills_lead',
        'other_skills_lead', // Newly added field
        'desired_career',
        'inquiry_submitted',
        'details_sent',
        'response_date',
        'inquiry_status',
        'source',
    ];
    // Define default values for the inquiry_status (if not explicitly set)
    protected $attributes = [
        'inquiry_status' => 'New',
    ];
}