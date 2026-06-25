@props([
    'project' => [],
    'delay' => 0,
])

@php
    $title = $project->title;
    $category = $project->category;
    $excerpt = $project->excerpt;
@endphp

<a href="{{ route('project', ['slug' => $project->slug]) }}"
   class="reveal group relative block overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-brand-600/10"
   data-delay="{{ $delay }}">

    {{-- Image / thumbnail --}}
    <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-brand-50 to-brand-100">
        @if ($project->image_url)
            <img src="{{ $project->image_url }}" alt="{{ $title }}"
                 loading="lazy" decoding="async"
                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                 onerror="this.style.display='none'">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-brand-950/70 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <span class="absolute top-4 {{ app()->getLocale() === 'ar' ? 'end-4' : 'start-4' }} rounded-full bg-white/90 px-3 py-1 text-xs font-bold text-brand-600 backdrop-blur">
            {{ $category }}
        </span>
    </div>

    {{-- Body --}}
    <div class="p-6">
        <div class="flex items-center justify-between gap-3">
            <h3 class="text-lg font-bold text-slate-900 transition-colors group-hover:text-brand-600">{{ $title }}</h3>
            <span class="text-xs font-semibold text-slate-400">{{ $project->year }}</span>
        </div>
        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-slate-500">{{ $excerpt }}</p>
        <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600">
            {{ __('site.view_details') }}
            <x-icon name="arrow" class="h-4 w-4 transition-transform group-hover:{{ app()->getLocale() === 'ar' ? '-translate-x-1' : 'translate-x-1' }} {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}" />
        </span>
    </div>
</a>
