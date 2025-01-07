<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadInfo extends Model
{
    use HasFactory;

    protected $table = 'lead_info';

    // Mass assignable attributes
    protected $fillable = [
        'lead_given_name',
        'lead_surname',
        'lead_middle_name',
        'lead_extension',
        'lead_email',
        'lead_mobile_number',
        'lead_address_city',
        'inquired_details',
        'lead_message',
        'extracurricular_interest_lead',
    ];
}
