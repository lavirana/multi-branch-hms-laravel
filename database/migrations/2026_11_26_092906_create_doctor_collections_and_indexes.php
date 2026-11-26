<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specializations', function (Blueprint $collection) {
            $collection->unique('name');
        });

        Schema::create('doctors', function (Blueprint $collection) {
            $collection->unique('license_no');
            $collection->index('specialization_id');
            $collection->index('branches.branch_id'); // fast filter: doctors of one branch
            $collection->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('specializations');
    }
};