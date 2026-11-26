<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class StoreDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8'],
            'specialization_id' => ['required', 'string', Rule::exists('specializations', '_id')],
            'license_no' => ['required', 'string', 'max:50', Rule::unique('doctors', 'license_no')],
            'bio' => ['nullable', 'string', 'max:1000'],

            // optional: attach branches while creating
            'branches' => ['sometimes', 'array'],
            'branches.*.branch_id' => ['required', 'string', Rule::exists('branches', '_id')],
            'branches.*.consultation_fee' => ['required', 'integer', 'min:0'],
        ];
    }
}