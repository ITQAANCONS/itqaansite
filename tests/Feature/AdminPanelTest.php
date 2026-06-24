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
        return User::firstOrCreate(
            ['email' => 'pest-admin@example.com'],
            ['name' => 'Pest Admin', 'password' => bcrypt('password')],
        );
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
            '/admin/manage-integrations',
        ];

        foreach ($pages as $page) {
            $this->actingAs($user)->get($page)->assertOk();
        }
    }
}
