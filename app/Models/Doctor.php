<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use MongoDB\Laravel\Relations\EmbedsMany;

class Doctor extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'name', 'specialization_id', 'license_no', 'bio'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    // the embedded list: [{ branch_id, consultation_fee }, ...]
    public function branches(): EmbedsMany
    {
        return $this->embedsMany(DoctorBranch::class);
    }
}