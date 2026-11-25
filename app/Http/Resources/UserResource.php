<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role?->value,
            'branch_id' => $this->branch_id ? (string) $this->branch_id : null,
            'is_active' => $this->is_active,
        ];
    }
}