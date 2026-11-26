<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('code') && is_string($this->code)) {
            $this->merge(['code' => strtoupper($this->code)]);
        }
    }

    public function rules(): array
    {
        // on update, the route has a Branch model; on create it is null
        $branch = $this->route('branch');
        $ignoreId = $branch ? (string) $branch->getKey() : null;

        return [
            'name' => ['required', 'string', 'max:100'],
            'code' => [
                'required', 'string', 'max:20',
                Rule::unique('branches', 'code')->ignore($ignoreId, '_id'),
            ],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}