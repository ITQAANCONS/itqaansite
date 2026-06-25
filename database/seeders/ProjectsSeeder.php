<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /** Platform guess for the seeded showcase projects. */
    private array $platforms = [
        'art-creator' => 'website',
        'masar-legal' => 'webapp',
        'smart-retail' => 'ecommerce',
        'health-app' => 'mobile',
        'corporate-identity' => 'branding',
        'cloud-dashboard' => 'webapp',
    ];

    public function run(): void
    {
        foreach (config('site.projects', []) as $i => $p) {
            Project::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'title_ar' => $p['title']['ar'] ?? '',
                    'title_en' => $p['title']['en'] ?? '',
                    'category_ar' => $p['category']['ar'] ?? null,
                    'category_en' => $p['category']['en'] ?? null,
                    'client_ar' => $p['client']['ar'] ?? null,
                    'client_en' => $p['client']['en'] ?? null,
                    'url' => ($p['url'] ?? '#') === '#' ? null : ($p['url'] ?? null),
                    'year' => $p['year'] ?? null,
                    'platform' => $this->platforms[$p['slug']] ?? 'website',
                    'excerpt_ar' => $p['excerpt']['ar'] ?? null,
                    'excerpt_en' => $p['excerpt']['en'] ?? null,
                    'description_ar' => $p['description']['ar'] ?? null,
                    'description_en' => $p['description']['en'] ?? null,
                    'services' => $p['services'] ?? [],
                    'image' => $p['image'] ?? null, // legacy asset path (images/projects/*.svg)
                    'is_featured' => $i < 3,
                    'is_published' => true,
                    'sort_order' => $i,
                ],
            );
        }
    }
}
