@props(['post' => null, 'delay' => 0])

<a href="{{ route('post', ['slug' => $post->slug]) }}"
   class="reveal group flex flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-brand-600/10"
   data-delay="{{ $delay }}">

    <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-brand-50 to-brand-100">
        @if ($post->cover_url)
            <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" loading="lazy"
                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        @endif
        @if ($post->category)
            <span class="absolute top-4 {{ app()->getLocale() === 'ar' ? 'end-4' : 'start-4' }} rounded-full bg-white/90 px-3 py-1 text-xs font-bold text-brand-600 backdrop-blur">
                {{ $post->category }}
            </span>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-6">
        <h3 class="text-lg font-bold leading-snug text-slate-900 transition-colors group-hover:text-brand-600">{{ $post->title }}</h3>
        <p class="mt-2 line-clamp-2 flex-1 text-sm leading-relaxed text-slate-500">{{ $post->excerpt }}</p>
        <div class="mt-4 flex items-center justify-between text-xs font-medium text-slate-400">
            <span>{{ optional($post->published_at)->translatedFormat('d M Y') }}</span>
            <span>{{ $post->reading_time }} {{ __('site.blog_page.reading_time') }}</span>
        </div>
    </div>
</a>
