<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use App\Enums\Role;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        User::truncate(); // safe only because this is the test database
    }

    private function makeUser(Role $role = Role::Doctor, bool $active = true): User
    {
        return User::create([
            'name' => 'Test User',
            'email' => $role->value . '@test.com',
            'password' => 'password',
            'role' => $role,
            'is_active' => $active,
        ]);
    }

    public function test_user_can_login(): void
    {
        $this->makeUser();

        $this->postJson('/api/v1/auth/login', [
            'email' => 'doctor@test.com',
            'password' => 'password',
        ])
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonStructure(['data' => ['token', 'user' => ['id', 'name', 'email', 'role']]]);
    }

    public function test_wrong_password_is_rejected(): void
    {
        $this->makeUser();

        $this->postJson('/api/v1/auth/login', [
            'email' => 'doctor@test.com',
            'password' => 'wrong-password',
        ])->assertUnauthorized();
    }

    public function test_inactive_user_cannot_login(): void
    {
        $this->makeUser(Role::Doctor, false);

        $this->postJson('/api/v1/auth/login', [
            'email' => 'doctor@test.com',
            'password' => 'password',
        ])->assertForbidden();
    }

    public function test_doctor_cannot_open_admin_route(): void
    {
        Sanctum::actingAs($this->makeUser(Role::Doctor));

        $this->getJson('/api/v1/admin/ping')->assertForbidden();
    }

    public function test_super_admin_can_open_admin_route(): void
    {
        Sanctum::actingAs($this->makeUser(Role::SuperAdmin));

        $this->getJson('/api/v1/admin/ping')->assertOk();
    }
}