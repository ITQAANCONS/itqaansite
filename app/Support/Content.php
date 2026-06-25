<?php

namespace App\Support;

/**
 * Locale-aware page content with a translation-file fallback.
 *
 * Editable values are stored in the settings table keyed `<key>_<locale>`
 * (e.g. home_hero_title_ar). When unset, the public site falls back to the
 * default text in lang/{ar,en}/site.php — so the site always renders.
 */
class Content
{
    public static function get(string $key, ?string $fallback = null): ?string
    {
        $value = Settings::get($key . '_' . app()->getLocale());

        return ($value !== null && $value !== '') ? $value : $fallback;
    }
}
