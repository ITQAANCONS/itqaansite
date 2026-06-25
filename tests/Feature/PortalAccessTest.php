<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalAccessTest extends TestCase
{
    use RefreshDatabase;

    private function user(string $type): User
    {
        return User::create([
            'name' => ucfirst($type),
            'email' => "{$type}@example.com",
            'password' => bcrypt('password'),
            'type' => $type,
            'is_active' => true,
        ]);
    }

    public function test_client_can_access_portal_but_not_admin(): void
    {
        $client = $this->user(User::TYPE_CLIENT);

        $this->actingAs($client)->get('/portal')->assertOk();
        $this->actingAs($client)->get('/portal/tickets')->assertOk();
        $this->actingAs($client)->get('/portal/tickets/create')->assertOk();
        // Staff-only admin panel must reject clients.
        $this->actingAs($client)->get('/admin')->assertStatus(403);
    }

    public function test_staff_cannot_access_portal(): void
    {
        $staff = $this->user(User::TYPE_STAFF);

        $this->actingAs($staff)->get('/portal')->assertStatus(403);
    }

    public function test_inactive_user_is_blocked(): void
    {
        $client = $this->user(User::TYPE_CLIENT);
        $client->update(['is_active' => false]);

        $this->actingAs($client->fresh())->get('/portal')->assertStatus(403);
    }
}
