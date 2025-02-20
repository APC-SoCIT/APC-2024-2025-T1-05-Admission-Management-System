<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:accepted'],
            'acceptance_message' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
