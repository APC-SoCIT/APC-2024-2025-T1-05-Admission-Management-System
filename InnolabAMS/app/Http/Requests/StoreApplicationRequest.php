<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        Log::info('Validating application request');
        
        return [
            'student_type' => 'required',
            'apply_program' => 'required',
            'apply_grade_level' => 'required',
            'applicant_surname' => 'required',
            'applicant_given_name' => 'required',
            'applicant_date_birth' => 'required|date',
            'gender' => 'required',
            'applicant_mobile_number' => 'required',
            'applicant_address_street' => 'required',
            'applicant_address_city' => 'required',
            'applicant_address_province' => 'required',
            'school_name' => 'required',
            'school_address' => 'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_address' => 'required',
            'emergency_contact_mobile' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'birth_certificate.required_if' => 'The birth certificate is required for transferee/returning students.',
            'form_138.required_if' => 'Form 138 is required for transferee/returning students.',
            'good_moral.required_if' => 'Good moral certificate is required for transferee/returning students.',
            'photo_2x2.required_if' => '2x2 photo is required for transferee/returning students.',
            'apply_strand.required_if' => 'The strand is required for Senior High School applicants.',
            'previous_school.required_if' => 'The previous school is required for transferee students.',
            'transfer_reason.required_if' => 'The transfer reason is required for transferee students.',
        ];
    }
}
