<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        foreach (Role::cases() as $role) {
            User::create([
                'name' => ucfirst(str_replace('_', ' ', $role->value)),
                'email' => $role->value . '@hospital.test',
                'password' => 'password',
                'role' => $role,
                'is_active' => true,
            ]);
        }
    }
}
