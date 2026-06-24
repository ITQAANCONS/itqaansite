<?php

namespace App\Support;

/**
 * Helpers for reading bilingual content from config/site.php.
 */
class Site
{
    /** Localize a ['ar'=>..,'en'=>..] array (or return the value as-is). */
    public static function t(array|string|null $value): string
    {
        if (is_array($value)) {
            return $value[app()->getLocale()] ?? $value['ar'] ?? reset($value) ?: '';
        }
        return (string) ($value ?? '');
    }

    public static function services(): array
    {
        return config('site.services', []);
    }

    public static function service(string $slug): ?array
    {
        return collect(self::services())->firstWhere('slug', $slug);
    }

    public static function projects(): array
    {
        return config('site.projects', []);
    }

    public static function project(string $slug): ?array
    {
        return collect(self::projects())->firstWhere('slug', $slug);
    }

    public static function contact(): array
    {
        return config('site.contact', []);
    }
}
