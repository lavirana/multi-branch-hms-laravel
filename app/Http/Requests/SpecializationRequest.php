<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SpecializationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $specialization = $this->route('specialization');
        $ignoreId = $specialization ? (string) $specialization->getKey() : null;

        return [
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('specializations', 'name')->ignore($ignoreId, '_id'),
            ],
        ];
    }
}
