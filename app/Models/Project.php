<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'slug', 'title_ar', 'title_en', 'category_ar', 'category_en',
        'client_ar', 'client_en', 'url', 'year', 'platform',
        'excerpt_ar', 'excerpt_en', 'description_ar', 'description_en',
        'services', 'image', 'gallery', 'is_featured', 'is_published', 'sort_order',
    ];

    protected $casts = [
        'services' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public const PLATFORMS = [
        'website'   => ['ar' => 'موقع إلكتروني', 'en' => 'Website'],
        'webapp'    => ['ar' => 'نظام / منصة ويب', 'en' => 'Web app'],
        'mobile'    => ['ar' => 'تطبيق جوال', 'en' => 'Mobile app'],
        'ecommerce' => ['ar' => 'متجر إلكتروني', 'en' => 'E-commerce'],
        'branding'  => ['ar' => 'هوية بصرية', 'en' => 'Branding'],
        'other'     => ['ar' => 'أخرى', 'en' => 'Other'],
    ];

    /* ---- Localized accessors (mirror the old config-array shape) ---- */

    protected function loc(string $field): string
    {
        $locale = app()->getLocale();
        return (string) ($this->{"{$field}_{$locale}"} ?? $this->{"{$field}_ar"} ?? '');
    }

    public function getTitleAttribute(): string { return $this->loc('title'); }
    public function getCategoryAttribute(): string { return $this->loc('category'); }
    public function getClientAttribute(): string { return $this->loc('client'); }
    public function getExcerptAttribute(): string { return $this->loc('excerpt'); }
    public function getDescriptionAttribute(): string { return $this->loc('description'); }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }
        // Support both uploaded files (public disk) and legacy asset paths.
        return str_starts_with($this->image, 'images/')
            ? asset($this->image)
            : Storage::disk('public')->url($this->image);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('created_at');
    }
}
