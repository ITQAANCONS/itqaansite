<?php

namespace App\Services;

use App\Support\Settings;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Drafts a bilingual blog article with Claude (Anthropic Messages API).
 * Returns HTML bodies suitable for the Filament rich editor.
 */
class BlogAiGenerator
{
    private const ENDPOINT = 'https://api.anthropic.com/v1/messages';
    private const MODEL = 'claude-opus-4-8';

    /**
     * @param  array{topic:string,notes?:?string}  $input
     * @return array<string,mixed>
     */
    public function generate(array $input): array
    {
        $key = Settings::anthropicKey();
        if (! $key) {
            throw new RuntimeException('مفتاح Anthropic API غير مضبوط. أضفه في الإعدادات والتكاملات.');
        }

        $brief = "الموضوع: {$input['topic']}";
        if (! empty($input['notes'])) {
            $brief .= "\nملاحظات: {$input['notes']}";
        }

        $system = <<<SYS
            أنت كاتب محتوى تقني محترف لمدونة شركة "إتقان لتقنية المعلومات" (شركة سعودية لتطوير الحلول الرقمية).
            اكتب مقالاً تسويقياً تثقيفياً عالي الجودة بالعربية والإنجليزية حول الموضوع المعطى.
            - excerpt: جملة أو جملتان جذابتان.
            - body: مقال منظّم بصيغة HTML بسيطة فقط باستخدام <h2> و<h3> و<p> و<ul><li>. لا تستخدم <html> أو <body> أو أنماط.
            - اجعل النبرة احترافية وواضحة وموجهة لأصحاب الأعمال ورواد الأعمال.
            - طول المقال متوسط (٤-٧ فقرات) مع عناوين فرعية.
            SYS;

        $schema = [
            'type' => 'object',
            'additionalProperties' => false,
            'properties' => [
                'title_ar' => ['type' => 'string'],
                'title_en' => ['type' => 'string'],
                'category_ar' => ['type' => 'string'],
                'category_en' => ['type' => 'string'],
                'excerpt_ar' => ['type' => 'string'],
                'excerpt_en' => ['type' => 'string'],
                'body_ar' => ['type' => 'string'],
                'body_en' => ['type' => 'string'],
            ],
            'required' => ['title_ar', 'title_en', 'category_ar', 'category_en', 'excerpt_ar', 'excerpt_en', 'body_ar', 'body_en'],
        ];

        $response = Http::withHeaders([
            'x-api-key' => $key,
            'anthropic-version' => '2023-06-01',
            'content-type' => 'application/json',
        ])->timeout(120)->post(self::ENDPOINT, [
            'model' => self::MODEL,
            'max_tokens' => 4096,
            'system' => $system,
            'output_config' => ['format' => ['type' => 'json_schema', 'schema' => $schema]],
            'messages' => [
                ['role' => 'user', 'content' => "اكتب مقالاً عن:\n\n{$brief}"],
            ],
        ]);

        if ($response->failed()) {
            $message = $response->json('error.message') ?? $response->body();
            throw new RuntimeException('فشل الاتصال بـ Claude: ' . $message);
        }

        $text = collect($response->json('content', []))->firstWhere('type', 'text')['text'] ?? null;
        $data = json_decode((string) $text, true);
        if (! is_array($data)) {
            throw new RuntimeException('تعذّر تحليل رد الذكاء الاصطناعي.');
        }

        return $data;
    }
}
