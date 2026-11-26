<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class DoctorBranch extends Model
{
    protected $fillable = ['branch_id', 'consultation_fee'];

    protected function casts(): array
    {
        return ['consultation_fee' => 'integer'];
    }
}