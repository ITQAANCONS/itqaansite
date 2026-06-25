<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\ProjectRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        // Generate the panel's permissions (as in production), then grant them all.
        \Illuminate\Support\Facades\Artisan::call('shield:generate', [
            '--all' => true, '--option' => 'permissions', '--panel' => 'admin', '--no-interaction' => true,
        ]);

        $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super_admin']);
        $role->syncPermissions(\Spatie\Permission\Models\Permission::all());

        $user = User::firstOrCreate(
            ['email' => 'pest-admin@example.com'],
            ['name' => 'Pest Admin', 'password' => bcrypt('password'), 'type' => User::TYPE_STAFF, 'is_active' => true],
        );
        $user->assignRole('super_admin');

        return $user;
    }

    public function test_admin_pages_render(): void
    {
        $user = $this->admin();

        ProjectRequest::create([
            'name' => 'اختبار', 'email' => 'a@b.com', 'phone' => '0500000000',
            'project_type' => 'website', 'services' => ['web-development'],
            'description' => 'وصف تجريبي', 'status' => 'new',
        ]);
        ContactMessage::create([
            'name' => 'مرسل', 'email' => 'c@d.com', 'message' => 'رسالة تجريبية',
        ]);

        $pages = [
            '/admin',
            '/admin/project-requests',
            '/admin/contact-messages',
            '/admin/users',
            '/admin/projects',
            '/admin/manage-pages',
            '/admin/manage-integrations',
        ];

        foreach ($pages as $page) {
            $this->actingAs($user)->get($page)->assertOk();
        }
    }
}
