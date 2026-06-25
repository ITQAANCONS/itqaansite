<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BlogPost extends Model
{
    protected $fillable = [
        'slug', 'title_ar', 'title_en', 'category_ar', 'category_en',
        'excerpt_ar', 'excerpt_en', 'body_ar', 'body_en',
        'cover_image', 'author', 'status', 'published_at', 'is_featured', 'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    protected function loc(string $field): string
    {
        $locale = app()->getLocale();
        return (string) ($this->{"{$field}_{$locale}"} ?: $this->{"{$field}_ar"} ?? '');
    }

    public function getTitleAttribute(): string { return $this->loc('title'); }
    public function getCategoryAttribute(): string { return $this->loc('category'); }
    public function getExcerptAttribute(): string { return $this->loc('excerpt'); }
    public function getBodyAttribute(): string { return $this->loc('body'); }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image ? Storage::disk('public')->url($this->cover_image) : null;
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->body ?: ''));
        return max(1, (int) ceil($words / 200));
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()));
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('published_at')->orderByDesc('created_at');
    }
}
