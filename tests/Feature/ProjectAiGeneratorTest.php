<?php

namespace Tests\Feature;

use App\Services\ProjectAiGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ProjectAiGeneratorTest extends TestCase
{
    use RefreshDatabase;

    public function test_throws_a_clear_error_when_no_api_key(): void
    {
        config(['site.contact.email' => 'x@y.com']);
        putenv('ANTHROPIC_API_KEY'); // ensure unset

        $this->expectException(\RuntimeException::class);
        app(ProjectAiGenerator::class)->generate(['name' => 'Test']);
    }

    public function test_parses_structured_response_into_fields(): void
    {
        \App\Models\Setting::put('anthropic_api_key', 'sk-ant-test');

        Http::fake([
            'api.anthropic.com/*' => Http::response([
                'content' => [[
                    'type' => 'text',
                    'text' => json_encode([
                        'title_ar' => 'مشروع', 'title_en' => 'Project',
                        'category_ar' => 'تصنيف', 'category_en' => 'Category',
                        'client_ar' => 'عميل', 'client_en' => 'Client',
                        'excerpt_ar' => 'مختصر', 'excerpt_en' => 'Excerpt',
                        'description_ar' => 'وصف', 'description_en' => 'Description',
                        'platform' => 'website', 'services' => ['web-development'],
                    ]),
                ]],
            ], 200),
        ]);

        $data = app(ProjectAiGenerator::class)->generate(['name' => 'Test', 'url' => 'https://x.com']);

        $this->assertSame('Project', $data['title_en']);
        $this->assertSame('website', $data['platform']);
        $this->assertContains('web-development', $data['services']);
    }
}
