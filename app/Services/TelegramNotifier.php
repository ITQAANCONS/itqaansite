<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Models\ProjectRequest;
use App\Support\Settings;
use App\Support\Site;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramNotifier
{
    /** Send a raw HTML message to the configured Telegram chat. */
    public function send(string $text): bool
    {
        if (! Settings::telegramEnabled()) {
            return false;
        }

        $token = Settings::get('telegram_bot_token');
        $chatId = Settings::get('telegram_chat_id');

        try {
            $response = Http::timeout(8)
                ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                    'disable_web_page_preview' => true,
                ]);

            if ($response->failed()) {
                Log::warning('Telegram notification failed: ' . $response->body());
                return false;
            }
            return true;
        } catch (\Throwable $e) {
            Log::error('Telegram notification error: ' . $e->getMessage());
            return false;
        }
    }

    public function notifyProjectRequest(ProjectRequest $r): void
    {
        $type = Site::t(config('site.request_options.project_types.' . $r->project_type) ?? $r->project_type);
        $budget = $r->budget ? Site::t(config('site.request_options.budgets.' . $r->budget) ?? '') : '—';
        $timeline = $r->timeline ? Site::t(config('site.request_options.timelines.' . $r->timeline) ?? '') : '—';
        $services = collect($r->services ?? [])
            ->map(fn ($s) => ($svc = Site::service($s)) ? Site::t($svc['title']) : $s)
            ->implode('، ');

        $text = "🚀 <b>طلب مشروع جديد</b>\n\n"
            . "👤 <b>الاسم:</b> " . e($r->name) . "\n"
            . "📧 <b>البريد:</b> " . e($r->email) . "\n"
            . "📱 <b>الجوال:</b> " . e($r->phone) . "\n"
            . ($r->company ? "🏢 <b>الجهة:</b> " . e($r->company) . "\n" : '')
            . "🧩 <b>النوع:</b> " . e($type) . "\n"
            . ($services ? "🛠 <b>الخدمات:</b> " . e($services) . "\n" : '')
            . "💰 <b>الميزانية:</b> " . e($budget) . "\n"
            . "⏱ <b>المدة:</b> " . e($timeline) . "\n\n"
            . "📝 " . e(mb_strimwidth($r->description, 0, 500, '…'));

        $this->send($text);
    }

    public function notifyContactMessage(ContactMessage $m): void
    {
        $text = "✉️ <b>رسالة تواصل جديدة</b>\n\n"
            . "👤 <b>الاسم:</b> " . e($m->name) . "\n"
            . "📧 <b>البريد:</b> " . e($m->email) . "\n"
            . ($m->phone ? "📱 <b>الجوال:</b> " . e($m->phone) . "\n" : '')
            . ($m->subject ? "🏷 <b>الموضوع:</b> " . e($m->subject) . "\n" : '')
            . "\n📝 " . e(mb_strimwidth($m->message, 0, 600, '…'));

        $this->send($text);
    }
}
