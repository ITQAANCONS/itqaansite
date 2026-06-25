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

    public static function anthropicKey(): ?string
    {
        return self::get('anthropic_api_key') ?: env('ANTHROPIC_API_KEY');
    }

    /** Path (relative to the public disk) of an uploaded logo, if any. */
    public static function logo(string $variant = 'default'): ?string
    {
        $key = $variant === 'white' ? 'site_logo_white' : 'site_logo';
        $path = self::get($key);
        return $path ? \Illuminate\Support\Facades\Storage::disk('public')->url($path) : null;
    }

    /**
     * Override Laravel's mail config from DB settings, so SMTP can be
     * managed from the admin panel instead of .env. Applied on boot.
     */
    public static function applyMailConfig(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        $host = self::get('mail_host');
        if (! $host) {
            return; // fall back to .env config
        }

        $encryption = self::get('mail_encryption'); // tls | ssl | ''
        $scheme = match ($encryption) {
            'ssl'   => 'smtps',
            'tls'   => 'smtp',
            default => null,
        };

        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.host' => $host,
            'mail.mailers.smtp.port' => (int) self::get('mail_port', 587),
            'mail.mailers.smtp.username' => self::get('mail_username'),
            'mail.mailers.smtp.password' => self::get('mail_password'),
            'mail.mailers.smtp.encryption' => $encryption ?: null,
            'mail.mailers.smtp.scheme' => $scheme,
        ]);

        if ($from = self::get('mail_from_address')) {
            config(['mail.from.address' => $from]);
        }
        if ($fromName = self::get('mail_from_name')) {
            config(['mail.from.name' => $fromName]);
        }
    }
}
