<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('branches', function (Blueprint $collection) {
            $collection->unique('code');
        });
    }

    public function down(): void
    {
        Schema::table('branches', function (Blueprint $collection) {
            $collection->dropIndex('code_1');
        });
    }
};