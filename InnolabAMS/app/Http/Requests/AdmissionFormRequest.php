<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdmissionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            // Common fields for all programs
            'first_name' => ['required', 'string', 'max:40'],
            'middle_name' => ['nullable', 'string', 'max:40'],
            'last_name' => ['required', 'string', 'max:40'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'age' => ['required', 'numeric', 'min:4', 'max:25'],
            'sex' => ['required', Rule::in(['Male', 'Female'])],
            'contact_number' => ['required', 'string', 'max:15'],
            'email' => ['required', 'email', 'max:255'],
            'address_street' => ['required', 'string', 'max:255'],
            'address_city' => ['required', 'string', 'max:255'],
            'address_province' => ['required', 'string', 'max:255'],
            'previous_school' => ['required', 'string', 'max:255'],
            'previous_school_address' => ['required', 'string', 'max:255'],

            // Program selection
            'program' => ['required', Rule::in(['Elementary', 'Junior High School', 'Senior High School'])],
            'grade_level' => ['required', 'string'],
        ];

        // Program-specific validation rules
        switch ($this->input('program')) {
            case 'Elementary':
                $rules = array_merge($rules, [
                    'birth_certificate' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'report_card' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'proof_of_residency' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'grade_level' => [Rule::in(['1', '2', '3', '4', '5', '6'])],
                ]);
                break;

            case 'Junior High School':
                $rules = array_merge($rules, [
                    'form_137' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'report_card' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'good_moral' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'grade_level' => [Rule::in(['7', '8', '9', '10'])],
                ]);
                break;

            case 'Senior High School':
                $rules = array_merge($rules, [
                    'form_137' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'report_card' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'good_moral' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                    'strand' => ['required', Rule::in(['STEM', 'ABM', 'HUMSS', 'GAS', 'TVL'])],
                    'grade_level' => [Rule::in(['11', '12'])],
                ]);
                break;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'birth_certificate.required' => 'Birth Certificate is required for Elementary admission.',
            'form_137.required' => 'Form 137 is required for admission.',
            'report_card.required' => 'Report Card is required for admission.',
            'good_moral.required' => 'Good Moral Certificate is required for admission.',
            'proof_of_residency.required' => 'Proof of Residency is required for Elementary admission.',
            'strand.required' => 'Please select a strand for Senior High School.',
            'grade_level.in' => 'Invalid grade level for selected program.',
            '*.mimes' => 'The :attribute must be a file of type: pdf, jpg, jpeg, png.',
            '*.max' => 'The :attribute must not be larger than 2MB.',
        ];
    }
}
