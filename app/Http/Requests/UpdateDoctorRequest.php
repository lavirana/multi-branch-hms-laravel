<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $ignoreId = (string) $this->route('doctor')->getKey();

        return [
            'name' => ['required', 'string', 'max:100'],
            'specialization_id' => ['required', 'string', Rule::exists('specializations', '_id')],
            'license_no' => [
                'required', 'string', 'max:50',
                Rule::unique('doctors', 'license_no')->ignore($ignoreId, '_id'),
            ],
            'bio' => ['nullable', 'string', 'max:1000'],
        ];
    }
}