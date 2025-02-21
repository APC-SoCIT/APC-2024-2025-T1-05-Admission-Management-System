<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'form_137' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:10240', 
            ],
        ];
    }
}