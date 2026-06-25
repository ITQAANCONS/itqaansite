<?php

namespace App\Services;

use App\Models\Project;
use App\Support\Settings;
use App\Support\Site;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Generates bilingual portfolio-project data with Claude (Anthropic Messages API).
 *
 * Uses Laravel's HTTP client with a structured-output schema so the model returns
 * strictly-typed JSON we can drop straight into the Project form. Matches the
 * raw-HTTP integration style already used by TelegramNotifier.
 */
class ProjectAiGenerator
{
    private const ENDPOINT = 'https://api.anthropic.com/v1/messages';
    private const MODEL = 'claude-opus-4-8';

    /**
     * @param  array{name:string,url?:?string,platform?:?string,notes?:?string}  $input
     * @return array<string,mixed>
     */
    public function generate(array $input): array
    {
        $key = Settings::anthropicKey();
        if (! $key) {
            throw new RuntimeException('مفتاح Anthropic API غير مضبوط. أضفه في الإعدادات والتكاملات.');
        }

        $serviceSlugs = array_keys(Site::serviceOptions());
        $serviceList = collect(Site::serviceOptions())
            ->map(fn ($label, $slug) => "$slug = $label")->implode('، ');
        $platformList = collect(Project::PLATFORMS)
            ->map(fn ($v, $k) => "$k = {$v['ar']}")->implode('، ');

        $brief = "اسم المشروع: {$input['name']}";
        if (! empty($input['url'])) {
            $brief .= "\nالرابط: {$input['url']}";
        }
        if (! empty($input['platform'])) {
            $brief .= "\nالنوع: {$input['platform']}";
        }
        if (! empty($input['notes'])) {
            $brief .= "\nملاحظات: {$input['notes']}";
        }

        $system = <<<SYS
            أنت كاتب محتوى تسويقي محترف لشركة "إتقان لتقنية المعلومات"، شركة سعودية لتطوير الحلول الرقمية.
            مهمتك توليد بيانات مشروع لعرضه في معرض أعمال الشركة (portfolio) بالعربية والإنجليزية.
            اكتب محتوى احترافياً وجذاباً وواقعياً يعكس جودة عمل الشركة، دون مبالغة أو ادعاءات كاذبة.
            - الوصف المختصر (excerpt): جملة أو جملتان.
            - الوصف الكامل (description): فقرة واحدة (٣-٥ جمل) تشرح المشروع والتحدي والحل والنتيجة.
            - اختر الخدمات (services) المناسبة فقط من القائمة المعطاة بمعرّفاتها (slugs).
            - اختر النوع (platform) الأنسب من القائمة المعطاة.
            الخدمات المتاحة: {$serviceList}
            الأنواع المتاحة: {$platformList}
            SYS;

        $schema = [
            'type' => 'object',
            'additionalProperties' => false,
            'properties' => [
                'title_ar' => ['type' => 'string'],
                'title_en' => ['type' => 'string'],
                'category_ar' => ['type' => 'string'],
                'category_en' => ['type' => 'string'],
                'client_ar' => ['type' => 'string'],
                'client_en' => ['type' => 'string'],
                'excerpt_ar' => ['type' => 'string'],
                'excerpt_en' => ['type' => 'string'],
                'description_ar' => ['type' => 'string'],
                'description_en' => ['type' => 'string'],
                'platform' => ['type' => 'string', 'enum' => array_keys(Project::PLATFORMS)],
                'services' => [
                    'type' => 'array',
                    'items' => ['type' => 'string', 'enum' => $serviceSlugs],
                ],
            ],
            'required' => [
                'title_ar', 'title_en', 'category_ar', 'category_en', 'client_ar', 'client_en',
                'excerpt_ar', 'excerpt_en', 'description_ar', 'description_en', 'platform', 'services',
            ],
        ];

        $response = Http::withHeaders([
            'x-api-key' => $key,
            'anthropic-version' => '2023-06-01',
            'content-type' => 'application/json',
        ])->timeout(60)->post(self::ENDPOINT, [
            'model' => self::MODEL,
            'max_tokens' => 2048,
            'system' => $system,
            'output_config' => [
                'format' => ['type' => 'json_schema', 'schema' => $schema],
            ],
            'messages' => [
                ['role' => 'user', 'content' => "ولّد بيانات هذا المشروع:\n\n{$brief}"],
            ],
        ]);

        if ($response->failed()) {
            $message = $response->json('error.message') ?? $response->body();
            throw new RuntimeException('فشل الاتصال بـ Claude: ' . $message);
        }

        $text = collect($response->json('content', []))
            ->firstWhere('type', 'text')['text'] ?? null;

        $data = json_decode((string) $text, true);
        if (! is_array($data)) {
            throw new RuntimeException('تعذّر تحليل رد الذكاء الاصطناعي.');
        }

        return $data;
    }
}
