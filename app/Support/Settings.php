<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

/**
 * Thin accessor for integration settings, with safe fallbacks so the public
 * site keeps working even before the settings table exists / is populated.
 */
class Settings
{
    public static function get(string $key, $default = null)
    {
        // Avoid DB hits before migrations have run (e.g. fresh install).
        if (! Schema::hasTable('settings')) {
            return $default;
        }
        return Setting::get($key, $default);
    }

    public static function telegramEnabled(): bool
    {
        return (bool) self::get('telegram_enabled', false)
            && self::get('telegram_bot_token')
            && self::get('telegram_chat_id');
    }

    public static function whatsappNumber(): ?string
    {
        $raw = self::get('whatsapp_number', config('site.contact.whatsapp'));
        $digits = preg_replace('/\D+/', '', (string) $raw);
        return $digits ?: null;
    }

    public static function notificationEmail(): string
    {
        return self::get('notification_email', config('site.contact.email'));
    }
}
